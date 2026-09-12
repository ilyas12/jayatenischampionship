{{--
    The four-column facts strip. It appears on the home page and again on the
    register page, where only the last column's label changes, so it takes its
    rows from the controller rather than being written out twice.

    Each row: icon, label, then one of value/note or a list.
--}}
<div class="jtc__facts">
  @foreach ($facts as $fact)
    <div class="jtc__fact">
      <span class="jtc__fact-icon">
        @include('jtc.partials.jtc_icon', ['name' => $fact['icon'], 'size' => 32])
      </span>

      <p class="jtc__fact-label">{{ $fact['label'] }}</p>

      @if (! empty($fact['list']))
        <p class="jtc__fact-list">
          @foreach ($fact['list'] as $line)
            {{ $line }}@if (! $loop->last)<br>@endif
          @endforeach
        </p>
      @else
        <p class="jtc__fact-value">{{ $fact['value'] }}</p>
        @if (! empty($fact['note']))
          <p class="jtc__fact-note">{{ $fact['note'] }}</p>
        @endif
      @endif
    </div>
  @endforeach
</div>
