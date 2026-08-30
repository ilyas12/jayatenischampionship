{{--
    Team detail.

    A one-shot event, so a club has no history to describe — no blurb. What it
    has is a position in this event, and how much of that exists depends on the
    phase: seeding appears with the draw, ties appear once there is one.

    Only public fields are shown. The linked registration carries the captain's
    email and phone; those stay in the admin.
--}}
@extends('tennis.layout')

@section('title', $team->name)
@section('description', $team->name . ' — squad and results at the Grandstand Open.')

@section('content')

  {{-- Hero. The squad photo sits behind it so the crest and name lead. --}}
  <section class="team-hero" @if ($team->photo) style="--team-photo: url('{{ $team->photo_url }}')" @endif>
    <div class="container-xl team-hero__inner">
      <p class="team-hero__crumb">
        <a href="{{ route('tennis_teams') }}">Teams</a> <span aria-hidden="true">/</span> {{ $team->name }}
      </p>

      <div class="team-hero__head">
        @if ($team->short_code)
          <span class="team-hero__crest">{{ $team->short_code }}</span>
        @endif

        <div class="team-hero__title">
          <h1>{{ $team->name }}</h1>
          <p class="team-hero__meta">
            {{ $team->city }}@if ($team->city && $team->founded) &middot; @endif
            @if ($team->founded) est. {{ $team->founded }} @endif
          </p>
        </div>

        {{-- Seeding is decided when the draw is made, so it stays hidden until then. --}}
        @if ($event && $event->showsSeeding() && ($team->seed || $team->team_group))
          <div class="team-hero__tags">
            @if ($team->seed)<span class="team-hero__tag team-hero__tag--gilt">Seed {{ $team->seed }}</span>@endif
            @if ($team->team_group)<span class="team-hero__tag">Group {{ strtoupper($team->team_group) }}</span>@endif
          </div>
        @endif
      </div>
    </div>
  </section>

  @php
    $played = $matches->whereNotNull('winner_team_id');
    $wins   = $played->where('winner_team_id', $team->id)->count();
    $losses = $played->count() - $wins;
    $drawn  = $matches->pluck('category_id')->filter()->unique()->count();
    $wonFinal = $matches->contains(function ($m) use ($team, $matches) {
        return $m->winner_team_id === $team->id && $m->round === $matches->max('round');
    });
  @endphp

  {{-- Facts. Every one is derived; nothing here is typed by an admin. --}}
  <section class="team-facts">
    <div class="container-xl">
      <div class="team-facts__grid">
        <div class="team-fact">
          <span class="team-fact__label">Squad</span>
          <span class="team-fact__value">{{ count($team->member_list) }}</span>
        </div>

        @if ($event && $event->showsResults() && $played->count())
          <div class="team-fact">
            <span class="team-fact__label">Record</span>
            <span class="team-fact__value">{{ $wins }}&ndash;{{ $losses }}</span>
          </div>
        @endif

        @if ($drawn > 1)
          <div class="team-fact">
            <span class="team-fact__label">Draws entered</span>
            <span class="team-fact__value">{{ $drawn }}</span>
          </div>
        @endif

        <div class="team-fact">
          <span class="team-fact__label">Status</span>
          <span class="team-fact__value team-fact__value--sm">
            @if ($event && $event->isFinished() && $wonFinal)
              Champion
            @elseif ($event && $event->showsDraw() && $matches->count())
              In the draw
            @elseif ($team->qualified)
              Qualified
            @else
              Registered
            @endif
          </span>
        </div>
      </div>
    </div>
  </section>

  {{-- Squad: the point of the page. --}}
  <section class="section section--tight">
    <div class="container-xl">
      <h2 class="h5 mb-4">Squad ({{ count($team->member_list) }})</h2>

      @if (count($team->member_list))
        <div class="squad-grid">
          @foreach ($team->member_list as $member)
            @php $person = $member['member']; @endphp
            <article class="squad-card">
              <div class="squad-card__photo">
                @if ($person->photo_url)
                  <img src="{{ $person->photo_url }}" alt="{{ $person->name }}" loading="lazy">
                @else
                  @include('tennis.partials.silhouette')
                @endif
              </div>
              <div class="squad-card__body">
                <h3 class="squad-card__name">{{ $person->name }}</h3>
                @if ($person->role || $person->rank)
                  <p class="squad-card__role">
                    {{ $person->role }}@if ($person->role && $person->rank) &middot; @endif
                    @if ($person->rank)#{{ $person->rank }}@endif
                  </p>
                @endif
                @if ($person->bio)
                  <p class="squad-card__bio">{{ $person->bio }}</p>
                @endif
              </div>
            </article>
          @endforeach
        </div>
      @else
        <div class="phase-notice">
          <h3 class="h5 mb-2">No players listed</h3>
          <p class="text-soft mb-0">The squad for this club has not been published yet.</p>
        </div>
      @endif
    </div>
  </section>

  {{-- Matches. Present in every phase; the notice covers the empty ones. --}}
  <section class="section batik-ground">
    <div class="container-xl">
      <div class="row g-5">
        <div class="col-lg-4">
          <span class="eyebrow">Record</span>
          <h2>Matches</h2>
          <div class="rule--gilt" role="presentation"><span></span></div>
          @if ($event && $event->showsResults() && $played->count())
            <p class="lede">
              {{ $wins }} {{ \Illuminate\Support\Str::plural('win', $wins) }} from {{ $played->count() }} played.
            </p>
          @endif
        </div>

        <div class="col-lg-8">
          @if ($matches->count())
            <div class="board">
              <div class="board__inner">
                <div class="table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <th scope="col">Draw</th>
                        <th scope="col">Round</th>
                        <th scope="col">Opponent</th>
                        <th scope="col">Score</th>
                        <th scope="col">Court</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($matches as $match)
                        @php
                          $isHome   = $match->home_team_id === $team->id;
                          $opponent = $isHome ? $match->away : $match->home;
                          $won      = $match->winner_team_id === $team->id;
                        @endphp
                        <tr>
                          <td class="board__round">{{ optional($match->category)->name ?: '—' }}</td>
                          <td class="board__round">{{ $match->label ?: $match->round_name }}</td>
                          <td>
                            @if ($match->winner_team_id)
                              <span class="{{ $won ? 'board__winner' : 'board__loser' }}">
                                {{ $won ? 'def.' : 'lost to' }}
                              </span>
                            @endif
                            <span>{{ $opponent ? $opponent->name : 'To be decided' }}</span>
                          </td>
                          <td class="board__score">{{ $match->result_score }}</td>
                          <td class="board__court">{{ $match->court }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @else
            @include('tennis.partials.phase-notice', ['what' => 'draw'])
          @endif
        </div>
      </div>
    </div>
  </section>

@endsection
