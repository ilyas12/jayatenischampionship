<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventTeamModel extends Model
{
    protected $table = 'event_teams';

    protected $fillable = [
        'event_id', 'registration_id', 'name', 'permalink', 'short_code', 'city', 'founded', 'photo',
        'description', 'seed', 'team_group', 'qualified', 'members',
        'order_id', 'publish',
    ];

    protected $casts = [
        'qualified' => 'boolean',
        'publish'   => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    /** Every tie this team appears in, either side, oldest round first. */
    public function matches()
    {
        return EventMatchModel::with(['home', 'away', 'winner', 'category'])
            ->where('event_id', $this->event_id)
            ->where('publish', 1)
            ->where(function ($q) {
                $q->where('home_team_id', $this->id)->orWhere('away_team_id', $this->id);
            })
            ->orderBy('round')->orderBy('order_id')->get();
    }

    public function registration()
    {
        return $this->belongsTo(EventRegistrationModel::class, 'registration_id');
    }

    /**
     * The `members` textarea parsed into rows.
     *
     * One player per line, "Name | Role | Rank"; role and rank optional. Blank
     * lines are skipped so trailing newlines do not become empty players.
     *
     * @return array<int, array{name:string, role:string, rank:string}>
     */
    public function getMemberListAttribute()
    {
        $rows = [];

        foreach (preg_split('/\R/', (string) $this->members) as $line) {
            if (trim($line) === '') {
                continue;
            }

            $parts = array_map('trim', explode('|', $line));

            $rows[] = [
                'name' => $parts[0],
                'role' => isset($parts[1]) ? $parts[1] : '',
                'rank' => isset($parts[2]) ? $parts[2] : '',
            ];
        }

        return $rows;
    }

    /**
     * Card image: the uploaded photo, else the placeholder crest for the team's
     * short code, else the generic one.
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return url('resources/assets/uploads/event_teams/' . $this->photo);
        }

        $code = strtolower((string) $this->short_code);
        $svg  = base_path('resources/assets/tennis/img/teams/' . $code . '.svg');

        return file_exists($svg) && $code !== ''
            ? url('resources/assets/tennis/img/teams/' . $code . '.svg')
            : url('resources/assets/images/none.png');
    }

    /** The value the front-end filter buttons match on. */
    public function getFilterKeyAttribute()
    {
        return trim(strtolower((string) $this->team_group) . ($this->qualified ? ' qualified' : ''));
    }
}
