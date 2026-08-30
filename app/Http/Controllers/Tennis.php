<?php

namespace terre\Http\Controllers;

use terre\Http\Models\EventModel;

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
        return view('tennis.home', ['tennisActive' => 'home']);
    }

    public function teams()
    {
        return view('tennis.teams', ['tennisActive' => 'teams']);
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
