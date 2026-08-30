{{--
    Stands in wherever a phase has no data yet, so a page is never blank and
    never removed from the nav.

    Expects $event and $what ('draw' or 'results').
--}}
@php
    $messages = [
        'draw' => [
            'registration' => ['The draw is not out yet', 'Entries are still open. The bracket is published once they close.'],
            'default'      => ['No draw published', 'Nothing has been drawn for this event yet.'],
        ],
        'results' => [
            'registration' => ['No results yet', 'The event has not started. Results appear here as ties are played.'],
            'draw'         => ['No results yet', 'The draw is set. Results appear here once play begins.'],
            'default'      => ['No results yet', 'Nothing has been played yet.'],
        ],
    ];

    $phase  = optional($event)->phase ?: 'registration';
    $set    = $messages[$what];
    $notice = isset($set[$phase]) ? $set[$phase] : $set['default'];
@endphp

<div class="phase-notice">
  <h3 class="h5 mb-2">{{ $notice[0] }}</h3>
  <p class="text-soft mb-0">{{ $notice[1] }}</p>

  @if ($event && $event->acceptsEntries())
    <a href="{{ route('tennis_registration') }}" class="btn btn-ink mt-3">Enter the tournament</a>
  @endif
</div>
