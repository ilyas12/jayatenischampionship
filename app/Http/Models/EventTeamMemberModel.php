<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventTeamMemberModel extends Model
{
    protected $table = 'event_team_members';

    protected $fillable = ['team_id', 'name', 'role', 'rank', 'bio', 'photo', 'order_id', 'publish'];

    protected $casts = ['publish' => 'boolean'];

    public function team()
    {
        return $this->belongsTo(EventTeamModel::class, 'team_id');
    }

    /**
     * The two illustrated stand-ins, used when a player has no portrait.
     *
     * Which one a player gets is keyed on their id, so it is stable between
     * renders — a squad does not reshuffle its placeholders on reload — while
     * still varying down the grid.
     */
    const PLACEHOLDERS = ['player-serve.jpg', 'player-forehand.jpg'];

    /** Picks a stand-in from an id, so the choice is stable between renders. */
    public static function placeholderFor($id)
    {
        $file = self::PLACEHOLDERS[abs((int) $id) % count(self::PLACEHOLDERS)];

        return url('resources/assets/jtc/img/players/' . $file);
    }

    public function getPlaceholderPhotoUrlAttribute()
    {
        return self::placeholderFor($this->id);
    }

    /** Uploaded portrait only; callers fall back to the placeholder above. */
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? url('resources/assets/uploads/event_team_members/' . $this->photo)
            : null;
    }

}
