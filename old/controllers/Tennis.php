<?php

namespace terre\Http\Controllers;

use terre\Http\Models\EventModel;
use terre\Http\Models\EventCategoryModel;
use terre\Http\Models\EventMatchModel;
use terre\Http\Models\EventScheduleModel;
use terre\Http\Models\EventTeamModel;

/**
 * Jaya Tennis Championship — the static slice of the tennis mockup.
 *
 * Content is still the mockup's markup: no data is read from the CMS yet. The
 * <!-- @foreach --> markers left in the views mark every place a query belongs
 * when the teams, draw and schedule get wired up.
 *
 * Self-contained under its own prefix (views in resources/views/tennis, assets
 * in resources/assets/tennis) so it cannot disturb the live site.
 */
class Tennis extends Controller
{
    /** Published order of play for an event, in date order. */
    protected function scheduleFor($event)
    {
        return $event
            ? EventScheduleModel::where('event_id', $event->id)->where('publish', 1)
                ->orderBy('starts_on')->orderBy('order_id')->get()
            : collect();
    }

    /** Published teams for an event, in display order. */
    protected function teamsFor($event)
    {
        return $event
            ? EventTeamModel::where('event_id', $event->id)->where('publish', 1)
                ->orderBy('order_id')->orderBy('name')->get()
            : collect();
    }

    public function home()
    {
        $event = EventModel::current();

        $teams = $this->teamsFor($event);

        $categories = EventCategoryModel::forEvent($event);

        $schedule = $this->scheduleFor($event);

        return view('tennis.home', [
            'tennisActive' => 'home',
            'event'        => $event,
            'schedule'     => $schedule,
            'categories'   => $categories,
            // Hero counters, all from the event's own data.
            // The strip shows a handful and links through; the counter above
            // it still reports the full field.
            'teams'        => $teams->take(6),
            'clubCount'    => $teams->count(),
            'playerCount'  => $teams->sum(function ($team) { return count($team->member_list); }),
            'dayCount'     => $schedule->pluck('starts_on')->filter()->unique()->count(),
        ]);
    }

    public function schedule()
    {
        $event    = EventModel::current();
        $schedule = $this->scheduleFor($event);

        return view('tennis.schedule', [
            'tennisActive' => 'schedule',
            'event'        => $event,
            'schedule'     => $schedule,
            'dayCount'     => $schedule->pluck('starts_on')->filter()->unique()->count(),
        ]);
    }

    public function teams()
    {
        // Teams belong to an event, so an empty/closed calendar shows an empty
        // grid rather than another event's entries.
        $event = EventModel::current();

        $teams = $this->teamsFor($event);

        return view('tennis.teams', [
            'tennisActive' => 'teams',
            'phase'        => optional($event)->phase,
            'event'        => $event,
            'teams'        => $teams,
            'groups'       => $teams->pluck('team_group')->filter()->unique()->sort()->values(),
            'playerCount'  => $teams->sum(function ($team) { return count($team->member_list); }),
        ]);
    }

    public function team($permalink)
    {
        $event = EventModel::current();

        // Scoped to the event: the same club can appear in more than one
        // tournament, and permalinks are only unique within one.
        $team = EventTeamModel::where('event_id', optional($event)->id)
            ->where('permalink', $permalink)
            ->where('publish', 1)
            ->firstOrFail();

        return view('tennis.team', [
            'tennisActive' => 'teams',
            'event'        => $event,
            'team'         => $team,
            // Before the draw exists a team has no ties; the page shows its
            // squad and says so rather than rendering an empty table.
            'matches'      => ($event && $event->showsDraw()) ? $team->matches() : collect(),
        ]);
    }

    public function bracket()
    {
        $event = EventModel::current();

        // The page always exists. Before the draw is published there is simply
        // nothing to show, which is a state the template handles rather than a
        // reason to hide the route or the nav item.
        $matches = ($event && $event->showsDraw())
            ? EventMatchModel::with(['home', 'away', 'winner', 'category'])
                ->where('event_id', $event->id)->where('publish', 1)
                ->orderBy('round')->orderBy('order_id')->orderBy('id')->get()
            : collect();

        $draws = EventCategoryModel::forEvent($event)
            ->map(function ($category) use ($matches, $event) {
                return $this->buildDraw(
                    $category->code,
                    $category->name,
                    $matches->where('category_id', $category->id),
                    $event
                );
            })
            ->filter(function ($draw) { return $draw['rounds']->count(); })
            ->values();

        $uncategorised = $matches->whereNull('category_id');

        if ($uncategorised->count()) {
            $draws->push($this->buildDraw('all', 'All ties', $uncategorised, $event));
        }

        return view('tennis.bracket', [
            'tennisActive' => 'bracket',
            'event'        => $event,
            'draws'        => $draws,
        ]);
    }

    /** Group one draw's matches into rounds, and work out its champion. */
    protected function buildDraw($key, $name, $matches, $event = null)
    {
        $rounds = $matches->groupBy('round')->map(function ($group) {
            return [
                'name'    => $group->first()->round_name ?: 'Round ' . $group->first()->round,
                'matches' => $group->values(),
            ];
        })->values();

        $finalMatch = $rounds->count() ? $rounds->last()['matches']->first() : null;

        return [
            'key'        => $key,
            'name'       => $name,
            'rounds'     => $rounds,
            // Results only once the event is actually being played; before
            // that a scored tie in the database is test data, not news.
            'results'    => ($event && $event->showsResults())
                ? $matches->filter(function ($m) { return $m->winner_team_id; })
                          ->sortByDesc('round')->values()
                : collect(),
            'finalMatch' => $finalMatch,
            'champion'   => optional($finalMatch)->winner,
        ];
    }

    public function registration()
    {
        // Whichever event is open, rather than a slug baked into the form.
        // Null renders the closed state instead of a form posting to a 404.
        $event = EventModel::current();

        return view('tennis.registration', [
            'tennisActive' => 'registration',
            'event'        => $event,
            'categories'   => EventCategoryModel::forEvent($event),
        ]);
    }
}
