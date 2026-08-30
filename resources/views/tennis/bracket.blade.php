@extends('tennis.layout')

@section('title', 'The draw')
@section('description', 'Live competition bracket for the Jaya Tennis Championship 2026 club team championship — quarter-finals through to the final.')

@section('content')

  <!-- ==================== PAGE HEAD ==================== -->
  <section class="section section--tight">
    <div class="container-xl">
      <nav aria-label="Breadcrumb" class="mb-4">
        <span class="eyebrow eyebrow--muted mb-0"><a href="{{ route('tennis_home') }}" class="text-decoration-none text-soft">Tournament</a> &nbsp;/&nbsp; The draw</span>
      </nav>
      <div class="row g-4 align-items-end">
        <div class="col-lg-7">
          <h1 class="mb-0">The draw</h1>
        </div>
        <div class="col-lg-5">
          <p class="lede mb-0">
            Club team championship, knockout from the last eight.
            Scores update as each tie is signed off by the referee.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== BRACKET ==================== -->
  <section class="section section--paper" style="padding-top:3rem">
    <div class="container-xl">

      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div class="filter-bar" role="group" aria-label="Choose a draw">
          @foreach ($draws as $i => $draw)
            <button type="button" class="filter-btn{{ $i === 0 ? ' is-active' : '' }}"
                    data-draw="{{ $draw['key'] }}">{{ $draw['name'] }}</button>
          @endforeach
        </div>
        <div class="legend">
          <span><b class="is-won"></b>Winner</span>
          <span><b></b>Eliminated</span>
          <span class="d-lg-none">Scroll sideways &rarr;</span>
        </div>
      </div>

      @forelse ($draws as $i => $draw)
      <div class="bracket-scroll" data-draw-panel="{{ $draw['key'] }}" @if ($i > 0) hidden @endif>
        <div class="bracket">

          @forelse ($draw['rounds'] as $round)
            <div class="round">
              <div class="round__title">{{ $round['name'] }}</div>
              <div class="round__body">
                {{-- The CSS connectors expect two matches per .pair; a round
                     with a single tie uses .pair--single. --}}
                @foreach ($round['matches']->chunk(2) as $pair)
                  <div class="pair{{ $pair->count() === 1 ? ' pair--single' : '' }}">
                    @foreach ($pair as $match)
                      <div class="match">
                        <div class="match__meta">
                          <span>{{ $match->label }}</span><span>{{ $match->meta }}</span>
                        </div>
                        @foreach (['home', 'away'] as $which)
                          @php($side = $match->side($which))
                          <div class="slot{{ $side['won'] ? ' slot--won' : '' }}{{ $side['tbd'] ? ' slot--tbd' : '' }}">
                            <span class="slot__seed">{{ $side['seed'] ?: '—' }}</span>
                            <span class="slot__name">{{ $side['name'] }}</span>
                            <span class="slot__score">{{ $side['score'] }}</span>
                          </div>
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                @endforeach
              </div>
            </div>
          @empty
            <p class="text-soft">The draw has not been published yet.</p>
          @endforelse

          @if (count($draw['rounds']))
            {{-- Not a stored row: the champion is whoever won the last round. --}}
            <div class="round">
              <div class="round__title">Champion</div>
              <div class="round__body">
                <div class="pair pair--single">
                  <div class="match champion p-4">
                    <svg class="champion__cup" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                      <path d="M7 3h10v5a5 5 0 0 1-10 0V3Z"/>
                      <path d="M7 5H4v1a4 4 0 0 0 3 3.9M17 5h3v1a4 4 0 0 1-3 3.9"/>
                      <path d="M12 13v5M8 21h8M10 18h4"/>
                    </svg>
                    <div class="champion__name">{{ $draw['champion'] ? $draw['champion']->name : 'To be decided' }}</div>
                    {{-- The final's own meta, not the event's closes_at: that is
                         when registration shuts, not when the final is played. --}}
                    @if ($draw['finalMatch'] && $draw['finalMatch']->meta)
                      <div class="eyebrow eyebrow--muted mt-2 mb-0">{{ $draw['finalMatch']->meta }}</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endif


        </div>
      </div>
      @empty
        @include('tennis.partials.phase-notice', ['what' => 'draw'])
      @endforelse

    </div>
  </section>

  <!-- ==================== RESULTS ==================== -->
  <section class="section batik-ground">
    <div class="container-xl">
      <div class="row g-5">
        <div class="col-lg-4">
          <span class="eyebrow">Completed</span>
          <h2>Results</h2>
          <div class="rule--gilt" role="presentation"><span></span></div>
          <p class="lede">Every tie is two singles rubbers and one doubles. Set scores as signed off by the referee.</p>
        </div>
        <div class="col-lg-8">
          @forelse ($draws as $i => $draw)
          <div class="board" data-draw-panel="{{ $draw['key'] }}" @if ($i > 0) hidden @endif>
            <div class="board__inner">
              <div class="table-responsive">
                <table>
                  <thead>
                    <tr>
                      <th scope="col">Round</th>
                      <th scope="col">Match</th>
                      <th scope="col">Score</th>
                      <th scope="col">Court</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($draw['results'] as $result)
                      <tr>
                        <td class="board__round">{{ $result->label }}</td>
                        <td>
                          <span class="board__winner">{{ optional($result->winner)->name }}</span>
                          <span class="board__beat">def.</span>
                          <span class="board__loser">{{ optional($result->loser)->name ?: 'bye' }}</span>
                        </td>
                        <td class="board__score">{{ $result->result_score }}</td>
                        <td class="board__court">{{ $result->court }}</td>
                      </tr>
                    @empty
                      <tr><td colspan="4">
                        @include('tennis.partials.phase-notice', ['what' => 'results'])
                      </td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @empty
            @include('tennis.partials.phase-notice', ['what' => 'results'])
          @endforelse
        </div>
      </div>
    </div>
  </section>

@endsection
