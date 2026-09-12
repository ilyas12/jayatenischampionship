<?php

namespace terre\Http\Controllers;

use terre\Http\Models\EventCategoryModel;
use terre\Http\Models\EventMatchModel;
use terre\Http\Models\EventModel;

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
        return view('jtc.jtc_home', [
            'active'     => 'jtc_home',
            'facts'      => $this->facts(),
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
            'stats' => [
                ['value' => '200+', 'label' => 'Players'],
                ['value' => '50+',  'label' => 'Companies'],
                ['value' => '300+', 'label' => 'Matches'],
                ['value' => '1',    'label' => "Stronger\nCommunity"],
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

    public function pastWinners()
    {
        $winners = [
            2025 => [
                ['category' => "Men's Doubles",      'names' => 'Andreas / Michael',   'photo' => 'jtc_champion_1.jpg'],
                ['category' => "Women's Doubles",    'names' => 'Cindy / Felicia',     'photo' => 'jtc_champion_2.jpg'],
                ['category' => 'Mixed Doubles',      'names' => 'Raymond / Nathalie',  'photo' => 'jtc_champion_3.jpg'],
                ['category' => 'Spirit of the Game', 'names' => 'Daniel Wirawan',      'photo' => 'jtc_champion_4.jpg'],
            ],
        ];

        // The PSD only dresses 2025. The other tabs are real years with no
        // content yet rather than copies of 2025 pretending to be history.
        foreach ([2024, 2023, 2022, 2021] as $year) {
            $winners[$year] = [];
        }

        return view('jtc.jtc_past_winners', [
            'active'  => 'jtc_past_winners',
            'years'   => [2025, 2024, 2023, 2022, 2021],
            'winners' => $winners,
        ]);
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
        $facts = $this->facts();
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
     * The four-column strip shared by the home and register pages. Register
     * relabels the last column, which is the only difference between them.
     */
    private function facts()
    {
        return [
            ['icon' => 'calendar', 'label' => 'Tournament date', 'value' => 'TBA', 'note' => '2026'],
            ['icon' => 'pin',      'label' => 'Venue',           'value' => 'Jakarta', 'note' => 'Indonesia'],
            ['icon' => 'people',   'label' => 'Categories',      'list'  => ["Men's Doubles", "Women's Doubles", 'Mixed Doubles']],
            ['icon' => 'trophy',   'label' => 'Open for registration', 'value' => 'Coming soon', 'note' => 'Stay tuned'],
        ];
    }

}
