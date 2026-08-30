<?php

namespace terre\Http\Controllers;

use terre\Http\Models\EventModel;
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
    public function home()
    {
        $event = EventModel::current();

        return view('tennis.home', [
            'tennisActive' => 'home',
            'event'        => $event,
            'schedule'     => $event
                ? EventScheduleModel::where('event_id', $event->id)->where('publish', 1)
                    ->orderBy('starts_on')->orderBy('order_id')->get()
                : collect(),
        ]);
    }

    public function teams()
    {
        // Teams belong to an event, so an empty/closed calendar shows an empty
        // grid rather than another event's entries.
        $event = EventModel::current();

        $teams = $event
            ? EventTeamModel::where('event_id', $event->id)->where('publish', 1)
                ->orderBy('order_id')->orderBy('name')->get()
            : collect();

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
        return view('tennis.bracket', ['tennisActive' => 'bracket']);
    }

    public function registration()
    {
        // Whichever event is open, rather than a slug baked into the form.
        // Null renders the closed state instead of a form posting to a 404.
        return view('tennis.registration', [
            'tennisActive' => 'registration',
            'event'        => EventModel::current(),
        ]);
    }
}
