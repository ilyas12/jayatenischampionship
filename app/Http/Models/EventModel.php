<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title', 'slug', 'description', 'venue', 'venue_detail', 'format', 'price',
        'payment_instructions', 'opens_at', 'closes_at', 'publish', 'phase',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'opens_at'  => 'datetime',
        'closes_at' => 'datetime',
        'publish'   => 'boolean',
    ];

    /** Phases, in the order an event moves through them. */
    const REGISTRATION = 'registration';
    const DRAW         = 'draw';
    const RUNNING      = 'running';
    const FINISHED     = 'finished';

    public static function phaseOptions()
    {
        return [
            self::REGISTRATION => 'Registration — entries open, draw not published',
            self::DRAW         => 'Draw — entries closed, bracket published',
            self::RUNNING      => 'Running — results appear as ties are played',
            self::FINISHED     => 'Finished — complete, champion decided',
        ];
    }

    /** Short label for the public site. */
    public function getPhaseLabelAttribute()
    {
        return ucfirst((string) $this->phase);
    }

    /**
     * Entries are accepted while the phase says so AND the window is open, so
     * a deadline can pass without an admin touching the phase, and an admin can
     * close early without editing dates.
     */
    public function acceptsEntries()
    {
        return $this->phase === self::REGISTRATION && $this->isOpen();
    }

    /** Seeding and pools are decided when the draw is made. */
    public function showsSeeding()
    {
        return in_array($this->phase, [self::DRAW, self::RUNNING, self::FINISHED], true);
    }

    public function showsDraw()
    {
        return $this->showsSeeding();
    }

    /** Nothing has been played until the event is running. */
    public function showsResults()
    {
        return in_array($this->phase, [self::RUNNING, self::FINISHED], true);
    }

    public function isFinished()
    {
        return $this->phase === self::FINISHED;
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistrationModel::class, 'event_id');
    }

    /**
     * The event currently accepting entries, or null.
     *
     * Mirrors isOpen() in SQL because that one needs a loaded row. Ordered by
     * closing date so the one shutting first wins when several overlap.
     */
    public static function current()
    {
        return static::where('publish', 1)
            ->where(function ($q) { $q->whereNull('opens_at')->orWhere('opens_at', '<=', now()); })
            ->where(function ($q) { $q->whereNull('closes_at')->orWhere('closes_at', '>=', now()); })
            ->orderByRaw('closes_at IS NULL, closes_at')
            ->first();
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
