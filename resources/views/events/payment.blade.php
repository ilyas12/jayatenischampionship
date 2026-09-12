{{-- Payment confirmation, shared by any event.

     Wears the 2026 chrome. It used the old theme's Bootstrap classes, which
     left with that theme — this is the one public page that still writes to
     the database, so it could not be archived with the rest. --}}
@extends('jtc.jtc_layout')

@section('title', 'Payment confirmation')

@section('content')
<section class="jtc__container jtc__section" style="max-width: 820px">

  <p class="jtc__eyebrow">{{ $event->title }}</p>
  <h1 class="jtc__display" style="font-size: clamp(32px, 4vw, 52px); margin-block: 10px 28px">
    Confirm your payment
  </h1>

  @if (session('uploaded'))
    <p class="jtc__alert jtc__alert--ok">Proof received. We will verify it and get back to you.</p>
  @endif

  <div class="jtc__panel">
    <p class="jtc__panel-label">Reference</p>
    <p class="jtc__panel-code">{{ $registration->code }}</p>

    <p class="jtc__panel-row">
      <span>Amount due</span>
      <strong>
        @if ($registration->amount)
          Rp {{ number_format($registration->amount, 0, ',', '.') }}
        @else
          See instructions
        @endif
      </strong>
    </p>
    <p class="jtc__panel-row">
      <span>Status</span>
      <strong>{{ \terre\Http\Models\EventRegistrationModel::statusOptions()[$registration->status] }}</strong>
    </p>
  </div>

  @if ($event->payment_instructions)
    <div class="jtc__panel">
      <p class="jtc__panel-label">How to pay</p>
      <p>{!! nl2br(e($event->payment_instructions)) !!}</p>
    </div>
  @endif

  @if ($registration->status === \terre\Http\Models\EventRegistrationModel::PAID)
    <p>This registration is paid and confirmed. Nothing further is needed.</p>
  @else
    @if ($registration->payment_proof)
      <p class="jtc__aside-text">
        A proof was uploaded on {{ $registration->updated_at->format('d M Y H:i') }}.
        You can replace it below.
      </p>
    @endif

    @if ($errors->any())
      <div class="jtc__alert jtc__alert--error">
        <ul style="margin:0; padding-left:18px; list-style:disc">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('event_payment_upload', $registration->code) }}"
          enctype="multipart/form-data">
      @csrf
      <div class="jtc__field">
        <label for="proof">Proof of payment (JPG, PNG or PDF, max 5 MB)</label>
        <input class="jtc__input" type="file" name="proof" id="proof"
               accept=".jpg,.jpeg,.png,.pdf" required>
      </div>
      <button class="jtc__btn jtc__btn--solid" type="submit">Upload proof</button>
    </form>
  @endif

</section>
@endsection
