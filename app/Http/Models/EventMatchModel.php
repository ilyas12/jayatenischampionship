<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventMatchModel extends Model
{
    protected $table = 'event_matches';

    protected $fillable = [
        'event_id', 'round', 'round_name', 'label', 'meta',
        'home_team_id', 'away_team_id', 'home_score', 'away_score',
        'winner_team_id', 'order_id', 'publish',
    ];

    protected $casts = ['publish' => 'boolean'];

    public function event()  { return $this->belongsTo(EventModel::class, 'event_id'); }
    public function home()   { return $this->belongsTo(EventTeamModel::class, 'home_team_id'); }
    public function away()   { return $this->belongsTo(EventTeamModel::class, 'away_team_id'); }
    public function winner() { return $this->belongsTo(EventTeamModel::class, 'winner_team_id'); }

    /**
     * One side of the tie, shaped for the template: the team (or null for TBD),
     * its seed, and the score written against it.
     */
    public function side($which)
    {
        $team = $which === 'home' ? $this->home : $this->away;

        return [
            'team'  => $team,
            'name'  => $team ? $team->name : 'To be decided',
            'seed'  => $team ? $team->seed : null,
            'score' => $which === 'home' ? $this->home_score : $this->away_score,
            'won'   => $team && $this->winner_team_id === $team->id,
            'tbd'   => ! $team,
        ];
    }
}
