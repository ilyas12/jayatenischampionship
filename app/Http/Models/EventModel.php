<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title', 'slug', 'description', 'price',
        'payment_instructions', 'opens_at', 'closes_at', 'publish',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'opens_at'  => 'datetime',
        'closes_at' => 'datetime',
        'publish'   => 'boolean',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistrationModel::class, 'event_id');
    }

    /** Whether the form should accept entries right now. */
    public function isOpen()
    {
        $now = now();

        return $this->publish
            && (is_null($this->opens_at)  || $this->opens_at  <= $now)
            && (is_null($this->closes_at) || $this->closes_at >= $now);
    }
}
