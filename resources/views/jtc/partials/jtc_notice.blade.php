{{--
    Shown where a section has nothing to render yet. A page whose data has not
    been published is still a page people navigate to on purpose — it says what
    is missing rather than showing an empty table, and it never removes itself
    from the nav.

    @include('jtc.partials.jtc_notice', [
        'title' => 'The draw has not been published',
        'text'  => 'It appears here once entries close.',
    ])
--}}
<div class="jtc__notice">
  <h2 class="jtc__notice-title">{{ $title }}</h2>
  @if (! empty($text))
    <p class="jtc__notice-text">{{ $text }}</p>
  @endif
</div>
