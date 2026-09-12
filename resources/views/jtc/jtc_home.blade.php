@extends('jtc.jtc_layout')

@section('title', 'Jaya Tennis Championship 2026')
@section('description', 'Jaya Tennis Championship 2026, Jakarta. A tournament for players, ideas and opportunities.')

@section('content')

  {{-- Hero. The wordmark is artwork, not type: the lockup has a custom
       double-N ligature no web font reproduces, so it ships as an image with
       the words in its alt text. --}}
  <section class="jtc__hero"
           style="background-image: url('{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_hero_home.jpg') }}')">
    <div class="jtc__container jtc__hero-inner">
      <p class="jtc__hero-meta">{{ $venue }}<br>{{ $year }}</p>

      <img class="jtc__hero-lockup"
           src="{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_headline_lockup.png') }}"
           alt="Jaya Tennis Championship" width="394" height="253">

      <p class="jtc__hero-campaign">A tournament for players, ideas and opportunities.</p>

      <div class="jtc__hero-actions">
        <a class="jtc__btn jtc__btn--solid" href="{{ route('jtc_register') }}">
          Register now @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 18])
        </a>
        <a class="jtc__btn jtc__btn--ghost" href="{{ route('jtc_schedule') }}">View schedule</a>
      </div>
    </div>

    <p class="jtc__hero-pillars" aria-hidden="true">Sport<br>People<br>Business<br>Community</p>
  </section>

  {{-- Event details --}}
  <section class="jtc__container">
    @include('jtc.partials.jtc_facts', ['facts' => $facts])
  </section>

  {{-- Quick links --}}
  <section class="jtc__quick">
    <div class="jtc__container">
      <div class="jtc__quick-grid">
        @foreach ($quickLinks as $link)
          <a class="jtc__quick-item" href="{{ $link['url'] }}">
            @include('jtc.partials.jtc_icon', ['name' => $link['icon'], 'size' => 42])
            <span class="jtc__quick-body">
              <span class="jtc__quick-title">{{ $link['title'] }}</span>
              <span class="jtc__quick-caption">
                @foreach ($link['caption'] as $line)
                  {{ $line }}@if (! $loop->last)<br>@endif
                @endforeach
              </span>
            </span>
            <span class="jtc__quick-arrow">
              @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 22])
            </span>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  {{-- About --}}
  <section class="jtc__about">
    <div class="jtc__about-figure"
         style="background-image: url('{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_about_player.jpg') }}')"
         role="img" aria-label="A player mid-swing at the Jaya Tennis Championship"></div>

    <div class="jtc__about-body">
      <div class="jtc__about-copy">
        <p class="jtc__eyebrow">About the event</p>
        <h2 class="jtc__serif">More Than<br>A Tournament</h2>
        <p class="jtc__about-text">
          Jaya Tennis Championship brings together business leaders, professionals, and tennis
          enthusiasts in a competitive and friendly environment. It&rsquo;s a platform to build
          connections, share experiences, and grow the tennis community in Indonesia.
        </p>
        <a class="jtc__btn jtc__btn--outline" href="{{ route('jtc_register') }}">
          Learn more @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 18])
        </a>
      </div>

      <ul class="jtc__pillars">
        @foreach ($pillars as $pillar)
          <li class="jtc__pillar">
            <span class="jtc__pillar-icon">
              @include('jtc.partials.jtc_icon', ['name' => $pillar['icon'], 'size' => 30])
            </span>
            <span>
              <span class="jtc__pillar-title">{{ $pillar['title'] }}</span>
              <span class="jtc__pillar-text">{{ $pillar['text'] }}</span>
            </span>
          </li>
        @endforeach
      </ul>
    </div>
  </section>

  {{-- Last edition in numbers. A boast about a tournament that has been
       played, so it is absent rather than zeroed until one has been. --}}
  @if ($lastEdition)
    <section class="jtc__numbers"
             style="background-image: url('{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_numbers_bg.jpg') }}')">
      <div class="jtc__container jtc__numbers-inner">
        <div class="jtc__numbers-title">
          <p class="jtc__eyebrow jtc__eyebrow--light">Last edition</p>
          <h2 class="jtc__serif">JTC {{ $lastEdition['year'] }}<br>in numbers</h2>
        </div>

        <div class="jtc__stats">
          @foreach ($lastEdition['stats'] as $stat)
            <div class="jtc__stat">
              <p class="jtc__stat-value">{{ $stat['value'] }}</p>
              <p class="jtc__stat-label">{!! nl2br(e($stat['label'])) !!}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- Partners --}}
  <section class="jtc__container jtc__partners">
    <p class="jtc__partners-heading">Our partners</p>
    <div class="jtc__partners-row">
      @foreach ($partners as $partner)
        <img src="{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/partners/' . $partner['file']) }}"
             alt="{{ $partner['name'] }}" loading="lazy">
      @endforeach
    </div>
  </section>

@endsection
