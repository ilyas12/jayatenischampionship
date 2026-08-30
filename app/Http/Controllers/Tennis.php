<?php

namespace terre\Http\Controllers;

use terre\Http\Models\EventModel;
use terre\Http\Models\EventCategoryModel;
use terre\Http\Models\EventMatchModel;
use terre\Http\Models\EventScheduleModel;
use terre\Http\Models\EventTeamModel;

/**
 * Grandstand Open — the static slice of the tennis mockup.
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

        $schedule = $event
            ? EventScheduleModel::where('event_id', $event->id)->where('publish', 1)
                ->orderBy('starts_on')->orderBy('order_id')->get()
            : collect();

        return view('tennis.home', [
            'tennisActive' => 'home',
            'event'        => $event,
            'schedule'     => $schedule,
            'categories'   => $categories,
            // Hero counters, all from the event's own data.
            'clubCount'    => $teams->count(),
            'playerCount'  => $teams->sum(function ($team) { return count($team->member_list); }),
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
            'event'        => $event,
            'teams'        => $teams,
            'groups'       => $teams->pluck('team_group')->filter()->unique()->sort()->values(),
            'playerCount'  => $teams->sum(function ($team) { return count($team->member_list); }),
        ]);
    }

    public function bracket()
    {
        $event = EventModel::current();

        $matches = $event
            ? EventMatchModel::with(['home', 'away', 'winner'])
                ->where('event_id', $event->id)->where('publish', 1)
                ->orderBy('round')->orderBy('order_id')->orderBy('id')->get()
            : collect();

        // One entry per column, in draw order.
        $rounds = $matches->groupBy('round')->map(function ($group) {
            return [
                'name'    => $group->first()->round_name ?: 'Round ' . $group->first()->round,
                'matches' => $group->values(),
            ];
        })->values();

        // The champion is the last round's winner, not a stored row.
        $finalMatch = $rounds->count() ? $rounds->last()['matches']->first() : null;
        $champion   = optional($finalMatch)->winner;

        return view('tennis.bracket', [
            'tennisActive' => 'bracket',
            'event'        => $event,
            'rounds'       => $rounds,
            'champion'     => $champion,
            'finalMatch'   => $finalMatch,
            // Results are the played ties, latest round first — not a separate
            // table, so a score can only ever be entered once.
            'results'      => $matches->filter(function ($m) { return $m->winner_team_id; })
                                      ->sortByDesc('round')->values(),
        ]);
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
