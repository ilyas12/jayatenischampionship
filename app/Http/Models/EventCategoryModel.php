<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategoryModel extends Model
{
    protected $table = 'event_categories';

    protected $fillable = [
        'event_id', 'code', 'name', 'description',
        'draw_size', 'status_label', 'order_id', 'publish',
    ];

    protected $casts = ['publish' => 'boolean'];

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    /** Published draws for an event, in display order. */
    public static function forEvent($event)
    {
        return $event
            ? static::where('event_id', $event->id)->where('publish', 1)
                ->orderBy('order_id')->orderBy('name')->get()
            : collect();
    }
}
