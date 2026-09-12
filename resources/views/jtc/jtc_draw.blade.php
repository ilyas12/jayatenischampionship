@extends('jtc.jtc_layout')

@section('title', 'Draw')
@section('description', 'The Jaya Tennis Championship draw — follow the bracket and match updates.')

@section('content')

  @include('jtc.partials.jtc_page_hero', [
      'image'    => 'jtc_hero_draw.jpg',
      'eyebrow'  => 'Tournament',
      'title'    => 'Draw',
      'campaign' => ['Follow the latest tournament draw', 'and match updates.'],
      'pillars'  => ['Sport', 'People', 'Business', 'Community'],
  ])

  <section class="jtc__container jtc__section--tight">

    <div class="jtc__tabs-row">
      <div class="jtc__tabs" role="tablist" aria-label="Category" data-jtc-tabs="draw">
        @foreach ($draws as $key => $draw)
          <button class="jtc__tab jtc__tab--caps {{ $loop->first ? 'is-active' : '' }}" type="button"
                  role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                  data-value="{{ $key }}">{{ $draw['name'] }}</button>
        @endforeach
      </div>

      <a class="jtc__btn jtc__btn--outline" href="#">
        @include('jtc.partials.jtc_icon', ['name' => 'download', 'size' => 18]) Download PDF
      </a>
    </div>

    @foreach ($draws as $key => $draw)
      <div data-jtc-pane="draw" data-value="{{ $key }}" @if (! $loop->first) hidden @endif>
        <div class="jtc__bracket-wrap">
          <div class="jtc__bracket">

            {{-- Five columns: the first carries the ties that are known, the
                 rest are placeholders until results decide them. An empty slot
                 is a box with nothing in it, exactly as the design shows. --}}
            @foreach ($draw['rounds'] as $round)
              <div>
                <h2 class="jtc__round-title">{{ $round['title'] }}</h2>
                <div class="jtc__round">
                  @foreach ($round['matchups'] as $matchup)
                    <div class="jtc__matchup {{ ! empty($round['linked']) ? 'jtc__matchup--linked' : '' }}">
                      @foreach ($matchup as $slot)
                        @if ($slot === null)
                          <div class="jtc__slot jtc__slot--empty"></div>
                        @elseif ($slot === 'CHAMPION')
                          <div class="jtc__slot jtc__slot--champion">Champion</div>
                        @else
                          <div class="jtc__slot">{{ $slot }}</div>
                        @endif
                      @endforeach
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach

          </div>
        </div>
      </div>
    @endforeach

  </section>

@endsection
