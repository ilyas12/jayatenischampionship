<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventMatchModel extends Model
{
    protected $table = 'event_matches';

    protected $fillable = [
        'event_id', 'category_id', 'round', 'round_name', 'label', 'meta', 'court',
        'home_team_id', 'away_team_id', 'home_score', 'away_score',
        'winner_team_id', 'order_id', 'publish',
    ];

    protected $casts = ['publish' => 'boolean'];

    public function event()    { return $this->belongsTo(EventModel::class, 'event_id'); }
    public function category() { return $this->belongsTo(EventCategoryModel::class, 'category_id'); }
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

    /** Played ties, newest round first — what the results board lists. */
    public function scopePlayed($query)
    {
        return $query->whereNotNull('winner_team_id');
    }

    /** The losing side, or null while the tie is undecided. */
    public function getLoserAttribute()
    {
        if (! $this->winner_team_id) {
            return null;
        }

        return $this->winner_team_id === $this->home_team_id ? $this->away : $this->home;
    }

    /**
     * Set scores read from the winner's side: home "6 6" against away "4 2"
     * becomes "6-4 6-2". Falls back to whatever was typed if the two sides do
     * not have the same number of sets.
     */
    public function getResultScoreAttribute()
    {
        // With no winner there is no winner's perspective; read it home-first
        // rather than falling through to away-first by accident.
        $winnerFirst = $this->winner_team_id
            ? $this->winner_team_id === $this->home_team_id
            : true;
        $win  = preg_split('/\s+/', trim((string) ($winnerFirst ? $this->home_score : $this->away_score)), -1, PREG_SPLIT_NO_EMPTY);
        $lose = preg_split('/\s+/', trim((string) ($winnerFirst ? $this->away_score : $this->home_score)), -1, PREG_SPLIT_NO_EMPTY);

        if (! $win || count($win) !== count($lose)) {
            return trim($this->home_score . ' ' . $this->away_score);
        }

        $sets = [];
        foreach ($win as $i => $game) {
            $sets[] = $game . '-' . $lose[$i];
        }

        return implode(' ', $sets);
    }

    /**
     * Court for the results board. Uses the column when set; otherwise falls
     * back to the tail of `meta` ("Fri · Centre" -> "Centre") so rows entered
     * before the column existed still show something.
     */
    public function getCourtAttribute($value)
    {
        if (! empty($value)) {
            return $value;
        }

        $parts = preg_split('/\s*[·|]\s*/u', (string) $this->meta, -1, PREG_SPLIT_NO_EMPTY);
        $tail  = $parts ? trim(end($parts)) : '';

        // A time is not a court.
        return preg_match('/^\d{1,2}[:.]\d{2}$/', $tail) ? '' : $tail;
    }
}
