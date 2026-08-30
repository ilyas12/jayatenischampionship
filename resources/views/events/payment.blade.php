{{-- Payment confirmation, shared by any event. Uses the tennis chrome for now;
     give it its own layout when a second event has a different theme. --}}
@extends('tennis.layout')

@section('title', 'Payment confirmation')

@section('content')
<section class="section">
  <div class="container-xl" style="max-width:760px">

    <p class="eyebrow">{{ $event->title }}</p>
    <h1 class="mb-4">Confirm your payment</h1>

    @if (session('uploaded'))
      <div class="alert alert-success">
        Proof received. We will verify it and get back to you.
      </div>
    @endif

    <div class="card-flat mb-4">
      <div class="card-body">
        <p class="mb-2">
          Reference<br>
          <strong style="font-size:1.4rem">{{ $registration->code }}</strong>
        </p>
        <p class="mb-2">
          Amount due:
          <strong>
            @if ($registration->amount)
              Rp {{ number_format($registration->amount, 0, ',', '.') }}
            @else
              See instructions
            @endif
          </strong>
        </p>
        <p class="mb-0">
          Status: <strong>{{ \terre\Http\Models\EventRegistrationModel::statusOptions()[$registration->status] }}</strong>
        </p>
      </div>
    </div>

    @if ($event->payment_instructions)
      <div class="card-flat mb-4">
        <div class="card-body">
          <span class="eyebrow">How to pay</span>
          <p class="mb-0">{!! nl2br(e($event->payment_instructions)) !!}</p>
        </div>
      </div>
    @endif

    @if ($registration->status === \terre\Http\Models\EventRegistrationModel::PAID)
      <p>This registration is paid and confirmed. Nothing further is needed.</p>
    @else
      @if ($registration->payment_proof)
        <p class="text-soft">
          A proof was uploaded on
          {{ $registration->updated_at->format('d M Y H:i') }}.
          You can replace it below.
        </p>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('event_payment_upload', $registration->code) }}"
            enctype="multipart/form-data">
        @csrf
        <label class="form-label" for="proof">Proof of payment (JPG, PNG or PDF, max 5 MB)</label>
        <input class="form-control mb-3" type="file" name="proof" id="proof"
               accept=".jpg,.jpeg,.png,.pdf" required>
        <button type="submit" class="btn btn-ink">Upload proof</button>
      </form>
    @endif

  </div>
</section>
@endsection
