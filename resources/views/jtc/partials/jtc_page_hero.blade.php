{{--
    The banner every page but the home page opens with: eyebrow, display title,
    uppercase campaign line, and the stacked pillars against the right edge.

    @include('jtc.partials.jtc_page_hero', [
        'image'    => 'jtc_hero_schedule.jpg',
        'eyebrow'  => 'Tournament',
        'title'    => 'Schedule',
        'campaign' => ['Matches, courts and more.', 'Stay updated throughout the tournament.'],
        'pillars'  => ['Sport', 'People', 'Business', 'Community'],
    ])
--}}
@php
    $campaign = $campaign ?? [];
    $pillars  = $pillars ?? [];
@endphp

<section class="jtc__page-hero"
         style="background-image: url('{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/' . $image) }}')">
  <div class="jtc__container jtc__page-hero-inner">
    @if (!empty($eyebrow))
      <p class="jtc__eyebrow jtc__eyebrow--light">{{ $eyebrow }}</p>
    @endif

    <h1 class="jtc__display jtc__display--light">{!! nl2br(e($title)) !!}</h1>

    @if ($campaign)
      <p class="jtc__campaign">
        @foreach ($campaign as $line)
          {{ $line }}@if (! $loop->last)<br>@endif
        @endforeach
      </p>
    @endif
  </div>

  @if ($pillars)
    <p class="jtc__page-hero-pillars" aria-hidden="true">
      @foreach ($pillars as $pillar)
        {{ $pillar }}@if (! $loop->last)<br>@endif
      @endforeach
    </p>
  @endif
</section>
