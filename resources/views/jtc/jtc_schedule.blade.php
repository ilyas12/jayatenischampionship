@extends('jtc.jtc_layout')

@section('title', 'Schedule')
@section('description', 'Match schedule, courts and results for the Jaya Tennis Championship.')

@section('content')

  @include('jtc.partials.jtc_page_hero', [
      'image'    => 'jtc_hero_schedule.jpg',
      'eyebrow'  => 'Tournament',
      'title'    => 'Schedule',
      'campaign' => ['Matches, courts and more.', 'Stay updated throughout the tournament.'],
      'pillars'  => ['Sport', 'People', 'Business', 'Community'],
  ])

  <section class="jtc__container jtc__section--tight">

    @if (count($matches))

      <div class="jtc__tabs-row">
        <div class="jtc__tabs jtc__tabs--divided" role="tablist" aria-label="Day" data-jtc-tabs="match:day">
          <button class="jtc__tab is-active" type="button" role="tab" aria-selected="true" data-value="all">All days</button>
          @foreach ($days as $day)
            <button class="jtc__tab" type="button" role="tab" aria-selected="false" data-value="{{ $day['key'] }}">
              {{ $day['label'] }}
              <small>{{ $day['date'] }}</small>
            </button>
          @endforeach
        </div>

        @if (count($categories) > 1)
          <span class="jtc__select">
            <label class="jtc__skip" for="jtc-category">Filter by category</label>
            <select id="jtc-category" data-jtc-filter="match:category">
              <option value="all">All categories</option>
              @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
              @endforeach
            </select>
            @include('jtc.partials.jtc_icon', ['name' => 'chevron-down', 'size' => 18])
          </span>
        @endif
      </div>

      {{-- One table holding every day. The day tabs and the category select
           each narrow it, and a row has to satisfy both. --}}
      <div class="jtc__table-wrap">
        <table class="jtc__table">
          <thead>
            <tr>
              <th scope="col">Time</th>
              <th scope="col">Court</th>
              <th scope="col">Category</th>
              <th scope="col">Round</th>
              <th scope="col">Players</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($matches as $match)
              <tr data-jtc-row="match"
                  data-day="{{ $match['day'] }}" data-category="{{ $match['category'] }}">
                <td>{{ $match['time'] }}</td>
                <td>{{ $match['court'] }}</td>
                <td>{{ $match['category'] }}</td>
                <td>{{ $match['round'] }}</td>
                <td>
                  <span class="jtc__players">
                    <span>{{ $match['home'] }}</span>
                    <span class="jtc__vs">vs</span>
                    <span>{{ $match['away'] }}</span>
                  </span>
                </td>
                <td>
                  <span class="jtc__status jtc__status--{{ strtolower($match['status']) }}">{{ $match['status'] }}</span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    @else
      @include('jtc.partials.jtc_notice', [
          'title' => 'The order of play has not been published',
          'text'  => 'Ties appear here with their court and time as they are scheduled.',
      ])
    @endif

  </section>

@endsection
