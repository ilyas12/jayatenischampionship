<?php

namespace terre\Http\Controllers;

use terre\Http\Models\EventCategoryModel;
use terre\Http\Models\EventMatchModel;
use terre\Http\Models\EventModel;
use terre\Http\Models\EventScheduleModel;
use terre\Http\Models\EventTeamMemberModel;
use terre\Http\Models\EventTeamModel;

/**
 * Jaya Tennis Championship — 2026 theme.
 *
 * A slice of JTC_Desktop_Master_New.psd, one method per artboard.
 *
 * The schedule and the draw read the CMS: both come out of event_matches, and
 * what they show follows the event's phase. The home page and past winners
 * are still the PSD's copy, held as arrays here rather than written into the
 * templates — the markup loops over data either way, so wiring the rest is a
 * matter of swapping an array for a query without touching the Blade.
 *
 * Deliberately not extending the CMS's base Controller. That constructor loads
 * site configuration and static content this theme does not read, and every
 * page would pay for queries it never uses.
 */
class Jtc extends \Illuminate\Routing\Controller
{
    public function home()
    {
        $event = EventModel::current();

        return view('jtc.jtc_home', [
            'active'     => 'jtc_home',
            'event'      => $event,
            'year'       => $event ? $this->editionYear($event) : date('Y'),
            'venue'      => $event && $event->venue ? $event->venue : 'Jakarta',
            'facts'      => $this->facts($event),
            'lastEdition'=> $this->lastEdition(),
            'quickLinks' => [
                [
                    'icon'    => 'calendar',
                    'title'   => 'Schedule',
                    'caption' => ['View match schedule', 'and court information'],
                    'url'     => route('jtc_schedule'),
                ],
                [
                    'icon'    => 'bracket',
                    'title'   => 'Draw',
                    'caption' => ['Follow the latest', 'tournament draw'],
                    'url'     => route('jtc_draw'),
                ],
                [
                    'icon'    => 'document',
                    'title'   => 'Register',
                    'caption' => ['Be part of', 'Jaya Tennis Championship'],
                    'url'     => route('jtc_register'),
                ],
            ],
            'pillars' => [
                ['icon' => 'people', 'title' => 'Competition', 'text' => 'Play at your best'],
                ['icon' => 'people', 'title' => 'Networking',  'text' => 'Meet new people'],
                ['icon' => 'chart',  'title' => 'Community',   'text' => 'A stronger tennis ecosystem'],
            ],
            'partners' => [
                ['name' => 'Jaya',        'file' => 'jtc_partner_jaya.png'],
                ['name' => 'BCA',         'file' => 'jtc_partner_bca.png'],
                ['name' => 'HEAD',        'file' => 'jtc_partner_head.png'],
                ['name' => 'Wilson',      'file' => 'jtc_partner_wilson.png'],
                ['name' => 'Pocari Sweat','file' => 'jtc_partner_pocari.png'],
                ['name' => 'Le Minerale', 'file' => 'jtc_partner_le_minerale.png'],
                ['name' => 'ASICS',       'file' => 'jtc_partner_asics.png'],
            ],
        ]);
    }

    /**
     * Champions by edition, read from the finals in event_matches.
     *
     * There is no past-winners table and no need for one: a champion is
     * whoever won the last round of a category, which the draw already
     * records. An edition only appears once it has produced one, so the year
     * tabs are editions with a result rather than a fixed list of years.
     */
    public function pastWinners()
    {
        // Only editions whose results are public. A scored tie in an event
        // still taking entries is an admin's working copy — the same reason
        // the draw stays hidden until its phase — and crowning a champion from
        // it here would contradict the draw page reading from the same rows.
        $events = EventModel::where('publish', 1)->get()
            ->filter(function ($event) { return $event->showsResults(); })
            ->values();

        // Every decided tie across every edition in one query, rather than a
        // pair of queries per year on a page that lists several.
        $matches = $events->count()
            ? EventMatchModel::with(['winner', 'category'])
                ->whereIn('event_id', $events->pluck('id'))
                ->where('publish', 1)
                ->whereNotNull('winner_team_id')
                ->get()
            : collect();

        $winners = [];

        foreach ($events as $event) {
            $ties = $matches->where('event_id', $event->id);

            if ($ties->isEmpty()) {
                continue;
            }

            $champions = [];

            // One champion per category: the winner of its highest round.
            foreach ($ties->groupBy('category_id') as $group) {
                $final = $group->sortByDesc('round')->first();

                if (! $final->winner) {
                    continue;
                }

                $champions[] = [
                    'category' => optional($final->category)->name ?: 'Champion',
                    'names'    => $final->winner->name,
                    'photo'    => $final->winner->photo_url ?: $final->winner->placeholder_photo_url,
                ];
            }

            if ($champions) {
                $winners[$this->editionYear($event, $ties)] = $champions;
            }
        }

        krsort($winners);

        return view('jtc.jtc_past_winners', [
            'active'  => 'jtc_past_winners',
            'years'   => array_keys($winners),
            'winners' => $winners,
        ]);
    }

    /**
     * The year an edition was played — which is not the year entries opened,
     * and the events table stores no year of its own. The ties carry the real
     * dates; the registration window is the fallback when none of them do.
     */
    private function editionYear($event, $ties = null)
    {
        $played = $ties
            ? $ties->pluck('starts_at')->filter()->max()
            : EventMatchModel::where('event_id', $event->id)->max('starts_at');

        if (is_string($played)) {
            $played = \Carbon\Carbon::parse($played);
        }

        if ($played) {
            return (int) $played->format('Y');
        }

        $fallback = $event->closes_at ?: $event->created_at;

        return $fallback ? (int) $fallback->format('Y') : (int) date('Y');
    }

    /**
     * The order of play, read from event_matches.
     *
     * A tie appears once it has a time on it. The day tabs are the days that
     * actually have ties, so there are no tabs leading to an empty table, and
     * the category filter is the event's own categories rather than a fixed
     * list of three.
     */
    public function schedule()
    {
        $event = EventModel::current();

        $matches = $event
            ? EventMatchModel::with(['home', 'away', 'category'])
                ->where('event_id', $event->id)->where('publish', 1)
                ->scheduled()->get()
            : collect();

        $days = $matches->groupBy('day_key')->keys()->values()
            ->map(function ($day, $i) {
                return [
                    'key'   => $day,
                    'label' => 'Day ' . ($i + 1),
                    'date'  => \Carbon\Carbon::parse($day)->format('D, j M'),
                ];
            })->all();

        return view('jtc.jtc_schedule', [
            'active'     => 'jtc_schedule',
            'event'      => $event,
            'days'       => $days,
            'categories' => $matches->pluck('category.name')->filter()->unique()->values()->all(),
            'matches'    => $matches->map(function ($match) {
                return [
                    'day'      => $match->day_key,
                    'time'     => $match->time_label,
                    'court'    => $match->court,
                    'category' => optional($match->category)->name ?: '—',
                    'round'    => $match->round_name ?: $match->label,
                    'home'     => $match->sideName('home'),
                    'away'     => $match->sideName('away'),
                    'status'   => $match->status_label,
                ];
            })->all(),
        ]);
    }

    /**
     * The bracket, one tab per category, read from event_matches.
     *
     * Hidden until the event reaches the draw phase: a bracket sitting in the
     * database before then is an admin's working copy, not something to
     * publish. The page stays reachable and says so.
     */
    public function draw()
    {
        $event = EventModel::current();

        $matches = ($event && $event->showsDraw())
            ? EventMatchModel::with(['home', 'away', 'winner', 'category'])
                ->where('event_id', $event->id)->where('publish', 1)
                ->orderBy('round')->orderBy('order_id')->orderBy('id')->get()
            : collect();

        $draws = [];

        foreach (EventCategoryModel::forEvent($event) as $category) {
            $ties = $matches->where('category_id', $category->id);

            if ($ties->count()) {
                $draws[$category->code ?: 'c' . $category->id] = [
                    'name'   => $category->name,
                    'rounds' => $this->rounds($ties),
                ];
            }
        }

        // Ties an admin has not filed under a category still belong somewhere.
        $loose = $matches->whereNull('category_id');

        if ($loose->count()) {
            $draws['all'] = ['name' => 'All ties', 'rounds' => $this->rounds($loose)];
        }

        return view('jtc.jtc_draw', [
            'active' => 'jtc_draw',
            'event'  => $event,
            'draws'  => $draws,
        ]);
    }

    /**
     * Group one category's ties into the columns the bracket draws, and append
     * the champion column the design ends on.
     */
    private function rounds($ties)
    {
        $rounds = $ties->groupBy('round')->map(function ($group) {
            $first = $group->first();

            return [
                'title'    => $first->round_name ?: 'Round ' . $first->round,
                'linked'   => true,
                'matchups' => $group->map(function ($match) {
                    return [$match->sideName('home'), $match->sideName('away')];
                })->values()->all(),
            ];
        })->values()->all();

        // The final's winner, if it has one. Nothing is stored as "champion";
        // it is whoever won the last round that has been played.
        $final    = $ties->sortByDesc('round')->first();
        $champion = $final && $final->winner ? $final->winner->name : null;

        $rounds[] = [
            'title'    => 'Champion',
            'matchups' => [[$champion ?: 'CHAMPION', null]],
        ];

        return $rounds;
    }

    public function register()
    {
        $facts = $this->facts(EventModel::current());
        $facts[3]['label'] = 'Registration period';

        return view('jtc.jtc_register', [
            'active'     => 'jtc_register',
            'facts'      => $facts,
            'categories' => [
                ['value' => 'md', 'name' => "Men's Doubles"],
                ['value' => 'wd', 'name' => "Women's Doubles"],
                ['value' => 'xd', 'name' => 'Mixed Doubles'],
            ],
            'information' => [
                ['icon' => 'document', 'label' => 'Entry Fee',           'value' => 'TBA'],
                ['icon' => 'people',   'label' => 'Tournament Format',   'value' => 'TBA'],
                ['icon' => 'calendar', 'label' => 'Rules & Regulations', 'value' => 'View Details', 'url' => '#'],
                ['icon' => 'document', 'label' => 'FAQ',                 'value' => 'View FAQ',     'url' => '#'],
            ],
        ]);
    }

    /**
     * The four-column strip shared by the home and register pages.
     *
     * Every column answers from the event now — dates from the days its ties
     * are played, categories from event_categories, the venue from the event
     * itself, and the last column from whether entries are open.
     */
    private function facts($event)
    {
        $dates      = $this->editionDates($event);
        $categories = EventCategoryModel::forEvent($event)->pluck('name')->all();

        return [
            [
                'icon'  => 'calendar',
                'label' => 'Tournament date',
                'value' => $dates ? $this->dateRange($dates) : 'TBA',
                'note'  => $event ? $this->editionYear($event) : date('Y'),
            ],
            [
                'icon'  => 'pin',
                'label' => 'Venue',
                'value' => $event && $event->venue ? $event->venue : 'TBA',
                'note'  => $event ? $event->venue_detail : null,
            ],
            [
                'icon'  => 'people',
                'label' => 'Categories',
                'list'  => $categories ?: ['To be announced'],
            ],
            $this->entryFact($event),
        ];
    }

    /** The last column: whether entries are open, and until when. */
    private function entryFact($event)
    {
        if ($event && $event->acceptsEntries()) {
            return [
                'icon'  => 'trophy',
                'label' => 'Open for registration',
                'value' => 'Open now',
                'note'  => $event->closes_at ? 'Until ' . $event->closes_at->format('j M') : 'Enter today',
            ];
        }

        if ($event && $event->closes_at && $event->closes_at->isPast()) {
            return ['icon' => 'trophy', 'label' => 'Registration', 'value' => 'Closed', 'note' => 'Entries are in'];
        }

        return ['icon' => 'trophy', 'label' => 'Open for registration', 'value' => 'Coming soon', 'note' => 'Stay tuned'];
    }

    /**
     * The most recent edition whose results are public, counted up for the
     * "in numbers" band. Null when no edition has been played — the band is a
     * boast about a past tournament and there is nothing to boast about yet.
     */
    private function lastEdition()
    {
        $event = EventModel::where('publish', 1)->get()
            ->filter(function ($e) { return $e->showsResults(); })
            ->sortByDesc(function ($e) { return $this->editionYear($e); })
            ->first();

        if (! $event) {
            return null;
        }

        $teamIds = EventTeamModel::where('event_id', $event->id)->where('publish', 1)->pluck('id');

        return [
            'year'  => $this->editionYear($event),
            'stats' => [
                [
                    'value' => (string) EventTeamMemberModel::whereIn('team_id', $teamIds)->where('publish', 1)->count(),
                    'label' => 'Players',
                ],
                ['value' => (string) $teamIds->count(), 'label' => 'Clubs'],
                [
                    'value' => (string) EventMatchModel::where('event_id', $event->id)->where('publish', 1)->count(),
                    'label' => 'Matches',
                ],
                ['value' => '1', 'label' => "Stronger\nCommunity"],
            ],
        ];
    }

    /** First and last day an edition is played, or null if nothing is dated. */
    private function editionDates($event)
    {
        if (! $event) {
            return null;
        }

        $days = EventMatchModel::where('event_id', $event->id)->where('publish', 1)
            ->whereNotNull('starts_at')->get()->pluck('starts_at');

        if ($days->isEmpty()) {
            $days = EventScheduleModel::where('event_id', $event->id)->where('publish', 1)
                ->whereNotNull('starts_on')->get()->pluck('starts_on');
        }

        return $days->isEmpty() ? null : [$days->min(), $days->max()];
    }

    /** "12 — 19 Oct", or a single day when that is all there is. */
    private function dateRange($dates)
    {
        list($from, $to) = $dates;

        if ($from->isSameDay($to)) {
            return $from->format('j M');
        }

        return $from->format('M') === $to->format('M')
            ? $from->format('j') . '–' . $to->format('j M')
            : $from->format('j M') . ' – ' . $to->format('j M');
    }

}
