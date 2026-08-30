<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistrationModel extends Model
{
    protected $table = 'event_registrations';

    protected $fillable = [
        'event_id', 'code', 'name', 'email', 'phone',
        'data', 'amount', 'status', 'payment_proof',
        'paid_at', 'verified_at', 'verified_by', 'admin_note',
    ];

    protected $casts = [
        'data'        => 'array',
        'amount'      => 'decimal:2',
        'paid_at'     => 'datetime',
        'verified_at' => 'datetime',
    ];

    /** Status values, mirroring the enum in the migration. */
    const PENDING  = 'pending';
    const AWAITING = 'awaiting_verification';
    const PAID     = 'paid';
    const REJECTED = 'rejected';

    /** Status values with admin-facing labels. */
    public static function statusOptions()
    {
        return [
            self::PENDING  => 'Pending payment',
            self::AWAITING => 'Awaiting verification',
            self::PAID     => 'Paid',
            self::REJECTED => 'Rejected',
        ];
    }

    /**
     * Stamp the audit columns wherever the status is changed — the admin
     * scaffold, the public upload, a future API — instead of in each caller.
     */
    protected static function booted()
    {
        static::saving(function ($registration) {
            if (! $registration->isDirty('status')) {
                return;
            }

            if ($registration->status === self::PAID && is_null($registration->paid_at)) {
                $registration->paid_at = now();
            }

            if (in_array($registration->status, [self::PAID, self::REJECTED], true)) {
                $registration->verified_at = now();
                $registration->verified_by = optional(auth()->user())->email ?: $registration->verified_by;
            }
        });

        // After the write, because a brand new registration has no id until then.
        static::saved(function ($registration) {
            if ($registration->wasChanged('status')) {
                $registration->syncTeam();
            }
        });
    }

    /**
     * Mirror a paid entry onto the public teams page.
     *
     * The registration is the source of truth for who is competing, so the
     * fields it collects are written every time. Seed, group, photo and the
     * blurb are editorial — assigned after entries close — so they are left
     * alone and an admin's work is never overwritten by a later status change.
     *
     * Losing paid status unpublishes the team rather than deleting it, for the
     * same reason.
     */
    public function syncTeam()
    {
        $team = EventTeamModel::where('registration_id', $this->id)->first();

        if ($this->status !== self::PAID) {
            if ($team) {
                $team->publish = false;
                $team->save();
            }

            return $team;
        }

        $data = (array) $this->data;

        $team = $team ?: new EventTeamModel(['registration_id' => $this->id]);

        $team->event_id   = $this->event_id;
        $team->name       = isset($data['team_name']) && $data['team_name'] !== ''
            ? $data['team_name']
            : $this->name;
        $team->short_code = isset($data['team_short']) ? $data['team_short'] : null;
        $team->city       = isset($data['city']) ? $data['city'] : null;
        $team->founded    = isset($data['founded']) && $data['founded'] !== '' ? (int) $data['founded'] : null;
        $team->members    = $this->membersAsLines();

        // The detail page is reached by slug, so a synced team needs one too.
        if (empty($team->permalink)) {
            $team->permalink = \Illuminate\Support\Str::slug($team->name) ?: 'team-' . $this->id;
        }
        $team->publish    = true;

        $team->save();

        return $team;
    }

    /**
     * The members repeater as the "Name | Role | Rank" lines event_teams stores,
     * so the same squad reads identically however it was entered.
     */
    protected function membersAsLines()
    {
        $lines = [];

        foreach ((array) data_get($this->data, 'members', []) as $member) {
            $name = trim((string) data_get($member, 'name'));

            if ($name === '') {
                continue;
            }

            $lines[] = trim(implode(' | ', array_filter([
                $name,
                trim((string) data_get($member, 'role')),
                trim((string) data_get($member, 'rank')),
            ], function ($part) { return $part !== ''; })));
        }

        return $lines ? implode("\n", $lines) : null;
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    /** The whole entry as a read-only block for the admin edit screen. */
    public function getSummaryHtmlAttribute()
    {
        return '<pre style="white-space:pre-wrap">'
            . e(json_encode($this->only(['code', 'name', 'email', 'phone', 'amount']) + (array) $this->data,
                            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            . '</pre>';
    }

    /** The uploaded proof, as a link, for the admin edit screen. */
    public function getProofHtmlAttribute()
    {
        if (empty($this->payment_proof)) {
            return '<em>No proof uploaded yet.</em>';
        }

        $url = url('resources/assets/uploads/payment_proof/' . $this->payment_proof);

        return '<a href="' . e($url) . '" target="_blank" rel="noopener">'
            . e($this->payment_proof) . '</a>';
    }

    /**
     * A public reference the registrant quotes on their bank transfer.
     *
     * Prefixed per event so two events cannot collide, and random rather than
     * sequential so nobody can guess another entry's code and upload proof
     * against it — the confirmation page looks registrations up by code alone.
     */
    public static function makeCode($eventId)
    {
        do {
            $code = sprintf('EV%02d-%s', $eventId, strtoupper(bin2hex(random_bytes(3))));
        } while (static::where('code', $code)->exists());

        return $code;
    }
}
