@extends('jtc.jtc_layout')

@section('title', 'Past Winners')
@section('description', 'Champions of the Jaya Tennis Championship — celebrating players, connections and a growing tennis community.')

@section('content')

  @include('jtc.partials.jtc_page_hero', [
      'image'    => 'jtc_hero_past_winners.jpg',
      'eyebrow'  => 'Our history',
      'title'    => "Past\nWinners",
      'campaign' => ['Celebrating players, connections', 'and a growing tennis community.'],
      'pillars'  => ['People', 'Business', 'Community', 'Through', 'Tennis'],
  ])

  <section class="jtc__container jtc__section--tight">

    {{-- Year tabs. Every year's champions are in the page; the strip shows one
         set at a time rather than making a round trip for four cards. --}}
    <div class="jtc__tabs" role="tablist" aria-label="Edition" data-jtc-tabs="year">
      @foreach ($years as $year)
        <button class="jtc__tab {{ $loop->first ? 'is-active' : '' }}" type="button"
                role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                data-value="{{ $year }}">{{ $year }}</button>
      @endforeach
    </div>

    <div class="jtc__section jtc__winners-layout">
      <div>
        @foreach ($winners as $year => $champions)
          <div data-jtc-pane="year" data-value="{{ $year }}" @if (! $loop->first) hidden @endif>
            <div class="jtc__winners-head">
              <h2 class="jtc__section-heading">{{ $year }} Champions</h2>
              <a class="jtc__link-arrow" href="#">
                View all categories @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 16])
              </a>
            </div>

            <div class="jtc__winner-grid">
              @foreach ($champions as $champion)
                <article class="jtc__winner">
                  <div class="jtc__winner-photo"
                       @if (! empty($champion['photo']))
                         style="background-image: url('{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/winners/' . $champion['photo']) }}')"
                       @endif
                       role="img"
                       aria-label="{{ $champion['names'] }} — {{ $champion['category'] }}"></div>
                  <p class="jtc__winner-category">{{ $champion['category'] }}</p>
                  <p class="jtc__winner-names">{{ $champion['names'] }}</p>
                </article>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>

      <aside class="jtc__aside">
        <h2 class="jtc__aside-title">About past winners</h2>
        <p class="jtc__aside-text">
          Jaya Tennis Championship has become a platform for players, business leaders, and tennis
          enthusiasts to compete, connect, and create lasting relationships.
        </p>
        <a class="jtc__btn jtc__btn--outline jtc__btn--block" href="#">
          View gallery @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 18])
        </a>
      </aside>
    </div>

  </section>

@endsection
