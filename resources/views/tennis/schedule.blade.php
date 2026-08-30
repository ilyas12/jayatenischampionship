{{--
    Order of play. The homepage carries a condensed version of the same rows;
    this is the full list with its own URL, so the nav item points at a page
    rather than an anchor part-way down another one.
--}}
@extends('tennis.layout')

@section('title', 'Order of play')
@section('description', 'Order of play for the Jaya Tennis Championship — session times, courts and entry notes.')

@section('content')

  <section class="section section--tight">
    <div class="container-xl">
      <p class="eyebrow">Order of play</p>
      <div class="row g-5 align-items-end">
        <div class="col-lg-7">
          <h1 class="mb-0">
            {{ $dayCount }} {{ \Illuminate\Support\Str::plural('day', $dayCount) }} of tennis
          </h1>
        </div>
        <div class="col-lg-5">
          <p class="lede mb-0">
            Gates open an hour before the first match. Order of play is confirmed
            at 18:00 the day before.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section--paper" style="padding-top:2rem">
    <div class="container-xl">
      @forelse ($schedule as $day)
        <div class="schedule-row">
          <div class="schedule-row__date">{{ $day->date_label }}</div>
          <div>
            <strong>{{ $day->title }}</strong>
            @if ($day->detail)<div class="text-soft">{{ $day->detail }}</div>@endif
          </div>
          <div class="schedule-row__note">{{ $day->note }}</div>
        </div>
      @empty
        <div class="phase-notice">
          <h3 class="h5 mb-2">The order of play is not out yet</h3>
          <p class="text-soft mb-0">Session times are published once the draw is made.</p>
          @if ($event && $event->acceptsEntries())
            <a href="{{ route('tennis_registration') }}" class="btn btn-ink mt-3">Enter the tournament</a>
          @endif
        </div>
      @endforelse
    </div>
  </section>

@endsection
