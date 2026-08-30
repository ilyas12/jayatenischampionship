<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventScheduleModel extends Model
{
    protected $table = 'event_schedule';

    protected $fillable = [
        'event_id', 'starts_on', 'title', 'detail', 'note', 'order_id', 'publish',
    ];

    protected $casts = [
        'starts_on' => 'date',
        'publish'   => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    /** "Mon 12 Oct", as the mockup prints it. Blank when no date is set. */
    public function getDateLabelAttribute()
    {
        return $this->starts_on ? $this->starts_on->format('D j M') : '';
    }
}
