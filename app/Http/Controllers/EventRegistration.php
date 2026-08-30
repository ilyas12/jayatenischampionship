<?php

namespace terre\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use terre\Http\Models\EventModel;
use terre\Http\Models\EventRegistrationModel;

/**
 * The public half of the event registration flow, for any event:
 *
 *   store()    form POST -> row with status=pending -> payment email -> confirm
 *   confirm()  payment instructions + proof upload form, found by code
 *   upload()   proof saved -> status=awaiting_verification -> admin takes over
 *
 * Only the generic fields are columns. Everything else the form posts is kept
 * verbatim in `data`, which is what lets a different event reuse this without
 * a schema change.
 */
class EventRegistration extends Controller
{
    /** Where proof images land; the admin list links to the same path. */
    const PROOF_DIR = 'resources/assets/uploads/payment_proof';

    /** Fields that are columns rather than `data`. */
    protected $generic = ['captain_name', 'captain_email', 'captain_phone'];

    public function store(Request $request, $slug)
    {
        $event = EventModel::where('slug', $slug)->firstOrFail();

        if (! $event->isOpen()) {
            return back()->withInput()
                ->withErrors(['event' => 'Registration for this event is closed.']);
        }

        $data = $request->validate([
            'captain_name'      => 'required|string|max:255',
            'captain_email'     => 'required|email|max:255',
            'captain_phone'     => 'required|string|max:40',
            'accept_rules'      => 'accepted',
            'members'           => 'array',
            'members.*.name'    => 'required_with:members|string|max:255',
            'members.*.dob'     => 'nullable|date',
            'members.*.rank'    => 'nullable|integer|min:1',
        ] + $this->eventFieldRules($request));

        $registration = EventRegistrationModel::create([
            'event_id' => $event->id,
            'code'     => EventRegistrationModel::makeCode($event->id),
            'name'     => $data['captain_name'],
            'email'    => $data['captain_email'],
            'phone'    => $data['captain_phone'],
            // Everything the form sent that is not a column or framework noise.
            'data'     => array_diff_key(
                $request->except(['_token', '_method']),
                array_flip($this->generic)
            ),
            'amount'   => $event->price,
            'status'   => EventRegistrationModel::PENDING,
        ]);

        $this->sendPaymentInstructions($registration, $event);

        return redirect()->route('event_payment', $registration->code);
    }

    /**
     * Loose rules for the event-specific fields. They vary per event, so they
     * are length-capped rather than enumerated — the strict rules that matter
     * (contact details, consent, members) are in store().
     */
    protected function eventFieldRules(Request $request)
    {
        $rules = [];

        foreach (array_keys($request->except(['_token', '_method', 'members'])) as $field) {
            if (! in_array($field, $this->generic, true)) {
                $rules[$field] = 'nullable|max:2000';
            }
        }

        return $rules;
    }

    protected function sendPaymentInstructions(EventRegistrationModel $registration, EventModel $event)
    {
        // Mail::send with a view rather than a Mailable class: nothing here
        // queues or reuses the message.
        Mail::send('emails.payment-instruction', compact('registration', 'event'),
            function ($message) use ($registration, $event) {
                $message->to($registration->email, $registration->name)
                        ->subject('Payment instructions — ' . $event->title
                                  . ' (' . $registration->code . ')');
            });
    }

    public function confirm($code)
    {
        $registration = EventRegistrationModel::where('code', $code)->firstOrFail();

        return view('events.payment', [
            'registration' => $registration,
            'event'        => $registration->event,
        ]);
    }

    public function upload(Request $request, $code)
    {
        $registration = EventRegistrationModel::where('code', $code)->firstOrFail();

        // Once an admin has confirmed the money, the entry is closed. Without
        // this a paid entry could be knocked back to awaiting_verification by
        // anyone holding the code.
        if ($registration->status === EventRegistrationModel::PAID) {
            return back()->withErrors(['proof' => 'This registration is already paid.']);
        }

        $request->validate([
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $file = $request->file('proof');
        $name = $registration->code . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(base_path(self::PROOF_DIR), $name);

        $registration->payment_proof = $name;
        $registration->status        = EventRegistrationModel::AWAITING;
        $registration->save();

        return redirect()->route('event_payment', $registration->code)
            ->with('uploaded', true);
    }
}
