@extends('tennis.layout')

@section('title', 'The Draw — Grandstand Open 2026')
@section('description', 'Live competition bracket for the Grandstand Open 2026 club team championship — quarter-finals through to the final.')

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
          <button type="button" class="filter-btn is-active">Club Teams</button>
          <button type="button" class="filter-btn">Men&rsquo;s Singles</button>
          <button type="button" class="filter-btn">Women&rsquo;s Singles</button>
          <button type="button" class="filter-btn">Doubles</button>
        </div>
        <div class="legend">
          <span><b class="is-won"></b>Winner</span>
          <span><b></b>Eliminated</span>
          <span class="d-lg-none">Scroll sideways &rarr;</span>
        </div>
      </div>

      <!-- Blade: foreach (rounds as round) ... foreach (round->matches as match) ... -->
      <div class="bracket-scroll">
        <div class="bracket">

          @forelse ($rounds as $round)
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

          @if (count($rounds))
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
                    <div class="champion__name">{{ $champion ? $champion->name : 'To be decided' }}</div>
                    {{-- The final's own meta, not the event's closes_at: that is
                         when registration shuts, not when the final is played. --}}
                    @if ($finalMatch && $finalMatch->meta)
                      <div class="eyebrow eyebrow--muted mt-2 mb-0">{{ $finalMatch->meta }}</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endif


        </div>
      </div>

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
          <div class="board">
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
                    <!-- Blade: foreach (results as result) -->
                  <tr>
                    <td class="board__round">QF 1</td>
                    <td>
                      <span class="board__winner">Senayan Racquet</span>
                      <span class="board__beat">def.</span>
                      <span class="board__loser">Bandung Baseline</span>
                    </td>
                    <td class="board__score">6&ndash;4 6&ndash;2</td>
                    <td class="board__court">Centre</td>
                  </tr>
                  <tr>
                    <td class="board__round">QF 2</td>
                    <td>
                      <span class="board__winner">Surabaya Smash</span>
                      <span class="board__beat">def.</span>
                      <span class="board__loser">Kemang Court</span>
                    </td>
                    <td class="board__score">7&ndash;6 3&ndash;6 6&ndash;4</td>
                    <td class="board__court">Court 1</td>
                  </tr>
                  <tr>
                    <td class="board__round">QF 3</td>
                    <td>
                      <span class="board__winner">Bali Topspin</span>
                      <span class="board__beat">def.</span>
                      <span class="board__loser">Medan Ace</span>
                    </td>
                    <td class="board__score">6&ndash;3 6&ndash;4</td>
                    <td class="board__court">Court 2</td>
                  </tr>
                  <tr>
                    <td class="board__round">QF 4</td>
                    <td>
                      <span class="board__winner">Yogyakarta Volley</span>
                      <span class="board__beat">def.</span>
                      <span class="board__loser">Makassar Netcord</span>
                    </td>
                    <td class="board__score">6&ndash;1 6&ndash;7 7&ndash;5</td>
                    <td class="board__court">Centre</td>
                  </tr>
                  <tr>
                    <td class="board__round">SF 1</td>
                    <td>
                      <span class="board__winner">Senayan Racquet</span>
                      <span class="board__beat">def.</span>
                      <span class="board__loser">Surabaya Smash</span>
                    </td>
                    <td class="board__score">7&ndash;5 6&ndash;4</td>
                    <td class="board__court">Centre</td>
                  </tr>
                    <!-- Blade: endforeach -->
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
