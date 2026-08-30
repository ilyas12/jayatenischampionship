{{-- Plain, table-free: this goes to whatever mail client the registrant uses. --}}
<p>Hello {{ $registration->name }},</p>

<p>
    Your registration for <strong>{{ $event->title }}</strong> has been received.
    It is not confirmed until payment is verified.
</p>

<p>
    <strong>Reference: {{ $registration->code }}</strong><br>
    @if ($registration->amount)
        Amount due: Rp {{ number_format($registration->amount, 0, ',', '.') }}
    @else
        Amount due: see the instructions below.
    @endif
</p>

@if ($event->payment_instructions)
    <p>{!! nl2br(e($event->payment_instructions)) !!}</p>
@endif

<p>
    Please quote <strong>{{ $registration->code }}</strong> on the transfer, then
    upload your proof of payment here:<br>
    <a href="{{ route('event_payment', $registration->code) }}">
        {{ route('event_payment', $registration->code) }}
    </a>
</p>

<p>Once we have checked it, you will hear from us.</p>
