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

    /** Uploaded portrait, or a generated initials avatar so rows never look broken. */
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? url('resources/assets/uploads/event_team_members/' . $this->photo)
            : null;
    }

}
