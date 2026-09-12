<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventPartnerModel extends Model
{
    protected $table = 'event_partners';

    protected $fillable = ['event_id', 'name', 'logo', 'url', 'order_id', 'publish'];

    protected $casts = ['publish' => 'boolean'];

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    /** An edition's published partners, in the order an admin arranged them. */
    public static function forEvent($event)
    {
        return $event
            ? static::where('event_id', $event->id)->where('publish', 1)
                ->orderBy('order_id')->orderBy('id')->get()
            : collect();
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? url('resources/assets/uploads/event_partners/' . $this->logo)
            : null;
    }
}
