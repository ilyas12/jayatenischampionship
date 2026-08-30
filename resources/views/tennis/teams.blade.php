@extends('tennis.layout')

@section('title', 'Teams and players')
@section('description', 'The sixteen clubs and their registered players for the Jaya Tennis Championship 2026.')

@section('content')

  <!-- ==================== PAGE HEAD ==================== -->
  <section class="section section--tight">
    <div class="container-xl">
      <nav aria-label="Breadcrumb" class="mb-4">
        <span class="eyebrow eyebrow--muted mb-0"><a href="{{ route('tennis_home') }}" class="text-decoration-none text-soft">Tournament</a> &nbsp;/&nbsp; Teams</span>
      </nav>
      <div class="row g-4 align-items-end">
        <div class="col-lg-7">
          <h1 class="mb-0">Teams &amp;<br>players</h1>
        </div>
        <div class="col-lg-5">
          <p class="lede mb-0">
            {{ $teams->count() }} {{ \Illuminate\Support\Str::plural('club', $teams->count()) }} confirmed for the team
            championship, with every registered player and their national ranking.
            @if ($event && $event->closes_at)
              Lists lock on {{ $event->closes_at->format('j F') }}.
            @endif
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== FILTER + GRID ==================== -->
  <section class="section section--paper" style="padding-top:3rem">
    <div class="container-xl">

      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
        <div class="filter-bar" role="group" aria-label="Filter teams by group">
          <button type="button" class="filter-btn is-active" data-filter="all">All teams</button>
          @foreach (($event && $event->showsSeeding()) ? $groups : collect() as $group)
            <button type="button" class="filter-btn" data-filter="{{ strtolower($group) }}">Group {{ strtoupper($group) }}</button>
          @endforeach
          @if ($event && $event->showsSeeding() && $teams->contains('qualified', true))
            <button type="button" class="filter-btn" data-filter="qualified">Qualified</button>
          @endif
        </div>
        <span class="text-soft small"><span id="teamCount">{{ $teams->count() }}</span> teams &middot; <span id="playerCount">{{ $playerCount }}</span> players</span>
      </div>

      <div class="row g-4" id="teamGrid">

        @forelse ($teams as $team)
          <div class="col-md-6 col-xl-4" data-group="{{ $team->filter_key }}">
            <article class="card-flat team-card">
              <figure class="team-card__photo">
                <a href="{{ route('tennis_team', $team->permalink) }}">
                  @if ($team->photo_url)
                    <img src="{{ $team->photo_url }}" alt="{{ $team->name }} squad"
                         width="720" height="480" loading="lazy">
                  @else
                    <img src="{{ $team->placeholder_photo_url }}" alt=""
                         class="team-card__illustration" width="720" height="480" loading="lazy">
                  @endif
                </a>
                @if ($team->short_code)
                  <span class="crest">{{ $team->short_code }}</span>
                @endif
              </figure>
              <div class="card-body d-flex flex-column h-100">
                <div class="team-card__head mb-3">
                  <h3 class="h5 mb-1">
                    <a href="{{ route('tennis_team', $team->permalink) }}">{{ $team->name }}</a>
                  </h3>
                  <div class="text-soft small">
                    {{ $team->city }}@if ($team->city && $team->founded) &middot; @endif
                    @if ($team->founded) est. {{ $team->founded }} @endif
                  </div>
                </div>

                {{-- Seeding is set when the draw is made; before that the
                     detail page hides it too, so the two must agree. --}}
                @if ($event && $event->showsSeeding() && ($team->seed || $team->team_group))
                  <div class="mb-3">
                    @if ($team->seed)<span class="tag tag--purple">Seed {{ $team->seed }}</span>@endif
                    @if ($team->team_group)<span class="tag">Group {{ strtoupper($team->team_group) }}</span>@endif
                  </div>
                @endif

                {{-- No spacer here. The description this card used to carry was
                     dropped with the one-shot-event change, and it was what
                     pushed the players toggle to the card's foot; keeping a
                     flex-grow stand-in just held the same hole open. --}}
                @if (count($team->member_list))
                  <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-{{ $team->id }}"
                     role="button" aria-expanded="false" aria-controls="team-{{ $team->id }}">
                    Players ({{ count($team->member_list) }}) &darr;
                  </a>
                  <div class="collapse mt-3" id="team-{{ $team->id }}">
                    <ul class="member-list">
                      @foreach ($team->member_list as $member)
                        <li>
                          <span class="member-list__who">
                            @include('tennis.partials.avatar', ['member' => $member['member']])
                            <span class="member-list__name">{{ $member['name'] }}</span>
                          </span>
                          <span>
                            {{ $member['role'] }}@if ($member['role'] && $member['rank']) &middot; @endif
                            @if ($member['rank'])#{{ $member['rank'] }}@endif
                          </span>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                @endif
              </div>
            </article>
          </div>
        @empty
          <p class="text-soft">No teams have been published for this event yet.</p>
        @endforelse

      </div>

      <p class="text-soft mt-5 mb-0" id="emptyState" hidden>No teams match this filter.</p>
    </div>
  </section>

  <!-- ==================== CTA ==================== -->
  <section class="section section--ink section--tight">
    <div class="container-xl">
      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h2 class="h3 mb-2">Your club is not listed?</h2>
          <p class="text-soft mb-0">Four places remain in the team championship. Entries close 28 September.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a href="{{ route('tennis_registration') }}" class="btn btn-outline-paper">Register a team</a>
        </div>
      </div>
    </div>
  </section>

@endsection
