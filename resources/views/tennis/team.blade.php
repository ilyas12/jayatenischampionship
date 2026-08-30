{{--
    Team detail. The mockup has no artboard for this page, so it is assembled
    from components the slice already defines — the teams-page card photo and
    crest, the bracket's slot rows, and the results board table — rather than
    inventing a new visual language.

    Only public fields are shown. The linked registration carries the captain's
    email and phone; those stay in the admin.
--}}
@extends('tennis.layout')

@section('title', $team->name)
@section('description', $team->description ?: $team->name . ' — squad and results at the Grandstand Open.')

@section('content')

  <section class="section section--tight">
    <div class="container-xl">
      <p class="eyebrow mb-3">
        <a href="{{ route('tennis_teams') }}">Teams</a> / {{ $team->name }}
      </p>

      <div class="row g-5 align-items-start">

        <div class="col-lg-5">
          <figure class="team-card__photo mb-0">
            <img src="{{ $team->photo_url }}" alt="{{ $team->name }} squad"
                 width="720" height="480">
            @if ($team->short_code)
              <span class="crest">{{ $team->short_code }}</span>
            @endif
          </figure>
        </div>

        <div class="col-lg-7">
          <h1 class="mb-2">{{ $team->name }}</h1>

          <div class="text-soft">
            {{ $team->city }}@if ($team->city && $team->founded) &middot; @endif
            @if ($team->founded) est. {{ $team->founded }} @endif
          </div>

          @if ($team->seed || $team->team_group || $team->qualified)
            <div class="mt-3">
              @if ($team->seed)<span class="tag tag--purple">Seed {{ $team->seed }}</span>@endif
              @if ($team->team_group)<span class="tag">Group {{ strtoupper($team->team_group) }}</span>@endif
              @if ($team->qualified)<span class="tag tag--ink">Qualified</span>@endif
            </div>
          @endif

          @if ($team->description)
            <p class="lede mt-4">{{ $team->description }}</p>
          @endif

          @if (count($team->member_list))
            <h2 class="h5 mt-5 mb-3">Squad ({{ count($team->member_list) }})</h2>
            <ul class="member-list">
              @foreach ($team->member_list as $member)
                <li>
                  <span>{{ $member['name'] }}</span>
                  <span>
                    {{ $member['role'] }}@if ($member['role'] && $member['rank']) &middot; @endif
                    @if ($member['rank'])#{{ $member['rank'] }}@endif
                  </span>
                </li>
              @endforeach
            </ul>
          @endif
        </div>

      </div>
    </div>
  </section>

  {{-- Every tie this team appears in, won or lost, played or still to come. --}}
  <section class="section batik-ground">
    <div class="container-xl">
      <div class="row g-5">
        <div class="col-lg-4">
          <span class="eyebrow">Record</span>
          <h2>Matches</h2>
          <div class="rule--gilt" role="presentation"><span></span></div>
          <p class="lede">
            @if ($matches->count())
              @php
                  $wins   = $matches->where('winner_team_id', $team->id)->count();
                  $played = $matches->whereNotNull('winner_team_id')->count();
              @endphp
              {{ $wins }} {{ \Illuminate\Support\Str::plural('win', $wins) }} from {{ $played }} played.
            @else
              No ties drawn yet.
            @endif
          </p>
        </div>

        <div class="col-lg-8">
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
                    @forelse ($matches as $match)
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
                    @empty
                      <tr><td colspan="5" class="text-soft">This team has no ties in the draw yet.</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
