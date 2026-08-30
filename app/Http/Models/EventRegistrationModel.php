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
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    /**
     * The whole entry as a read-only block for the admin edit screen — the
     * generic columns plus whatever event-specific fields landed in `data`.
     */
    public function getSummaryHtmlAttribute()
    {
        $rows = [
            'Code'   => $this->code,
            'Name'   => $this->name,
            'Email'  => $this->email,
            'Phone'  => $this->phone,
            'Amount' => $this->amount,
        ];

        foreach ((array) $this->data as $key => $value) {
            $label = ucwords(str_replace('_', ' ', $key));
            $rows[$label] = is_array($value) ? $this->renderNested($value) : $value;
        }

        $html = '<table class="table table-condensed">';
        foreach ($rows as $label => $value) {
            $html .= '<tr><th style="width:200px">' . e($label) . '</th><td>'
                . (strpos((string) $value, '<') === 0 ? $value : nl2br(e((string) $value)))
                . '</td></tr>';
        }

        return $html . '</table>';
    }

    /** Nested `data` entries — the members repeater, mainly. */
    protected function renderNested(array $value)
    {
        $html = '<ul style="margin:0;padding-left:18px">';
        foreach ($value as $row) {
            $parts = is_array($row)
                ? array_filter(array_map(function ($k, $v) {
                    return $v === null || $v === '' ? null : $k . ': ' . $v;
                }, array_keys($row), $row))
                : [$row];
            $html .= '<li>' . e(implode(' — ', $parts)) . '</li>';
        }

        return $html . '</ul>';
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
