@extends('tennis.layout')

@section('title', 'Grandstand Open 2026 — International Tennis Championship')
@section('description', 'The Grandstand Open 2026: eight days of championship tennis. Registration is open for singles, doubles and club team events.')

@section('content')

  <!-- ==================== HERO ==================== -->
  <section class="hero">
    <div class="container-xl">
      <div class="row align-items-center g-5">
        <div class="col-lg-7">
          <span class="eyebrow">12 &ndash; 19 October 2026 &middot; Senayan Courts</span>
          <h1 class="hero__title">The Grandstand<br>Open <em>2026</em></h1>
          <p class="lede">
            Eight days of championship tennis on grass. Singles, doubles
            and club team events &mdash; open to registered players of every grade.
          </p>
          <div class="d-flex flex-wrap gap-3 mt-4">
            <a href="{{ route('tennis_registration') }}" class="btn btn-ink">Enter the tournament</a>
            <a href="{{ route('tennis_bracket') }}" class="btn btn-outline-ink">View the draw</a>
          </div>

          <div class="hero__meta">
            <div class="row g-4">
              <div class="col-6 col-sm-3"><div class="hero__stat"><b>128</b><span>Players</span></div></div>
              <div class="col-6 col-sm-3"><div class="hero__stat"><b>16</b><span>Clubs</span></div></div>
              <div class="col-6 col-sm-3"><div class="hero__stat"><b>6</b><span>Categories</span></div></div>
              <div class="col-6 col-sm-3"><div class="hero__stat"><b>8</b><span>Days</span></div></div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="court">
            <div class="court__alley"></div>
            <div class="court__box"></div>
            <div class="court__ball"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== CATEGORIES ==================== -->
  <section class="section section--paper" id="categories">
    <div class="container-xl">
      <div class="row g-5">
        <div class="col-lg-4">
          <span class="eyebrow">Events</span>
          <h2>Six draws,<br>one champion each.</h2>
          <p class="lede mt-3">
            Entry closes when a draw is full. Seeding follows the national ranking list
            published two weeks before the first ball.
          </p>
        </div>
        <div class="col-lg-8">
          <div class="row g-4">
            <!-- foreach (categories as category) -->
            <div class="col-md-6">
              <article class="card-flat">
                <div class="card-body">
                  <div class="numbered">01</div>
                  <h3 class="mt-3">Men&rsquo;s Singles</h3>
                  <p class="text-soft mb-3">Best of three sets, championship tie-break in the deciding set.</p>
                  <span class="tag">Draw of 32</span> <span class="tag tag--purple">Open</span>
                </div>
              </article>
            </div>
            <div class="col-md-6">
              <article class="card-flat">
                <div class="card-body">
                  <div class="numbered">02</div>
                  <h3 class="mt-3">Women&rsquo;s Singles</h3>
                  <p class="text-soft mb-3">Best of three sets, championship tie-break in the deciding set.</p>
                  <span class="tag">Draw of 32</span> <span class="tag tag--purple">Open</span>
                </div>
              </article>
            </div>
            <div class="col-md-6">
              <article class="card-flat">
                <div class="card-body">
                  <div class="numbered">03</div>
                  <h3 class="mt-3">Doubles</h3>
                  <p class="text-soft mb-3">Men&rsquo;s, women&rsquo;s and mixed pairs. No-ad scoring throughout.</p>
                  <span class="tag">Draw of 16</span> <span class="tag tag--purple">Open</span>
                </div>
              </article>
            </div>
            <div class="col-md-6">
              <article class="card-flat">
                <div class="card-body">
                  <div class="numbered">04</div>
                  <h3 class="mt-3">Club Teams</h3>
                  <p class="text-soft mb-3">Four to eight players per club. Two singles and one doubles per tie.</p>
                  <span class="tag">Draw of 8</span> <span class="tag tag--ink">4 places left</span>
                </div>
              </article>
            </div>
            <!-- endforeach -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== SCHEDULE ==================== -->
  <section class="section" id="schedule">
    <div class="container-xl">
      <div class="row g-5">
        <div class="col-lg-4">
          <span class="eyebrow">Order of play</span>
          <h2>Eight days.</h2>
          <p class="lede mt-3">Gates open one hour before the first match. Order of play is confirmed at 18:00 the evening prior.</p>
        </div>
        <div class="col-lg-8">
          <!-- foreach (schedule as day) -->
          <div class="schedule-row">
            <div class="schedule-row__date">Mon 12 Oct</div>
            <div>
              <strong>Qualifying rounds</strong>
              <div class="text-soft">All courts &middot; 08:00 &ndash; 18:00</div>
            </div>
            <div class="schedule-row__note">Free entry</div>
          </div>
          <div class="schedule-row">
            <div class="schedule-row__date">Wed 14 Oct</div>
            <div>
              <strong>Main draw &mdash; first round</strong>
              <div class="text-soft">Centre &amp; Court 1 &middot; 10:00</div>
            </div>
            <div class="schedule-row__note">Ticketed</div>
          </div>
          <div class="schedule-row">
            <div class="schedule-row__date">Fri 16 Oct</div>
            <div>
              <strong>Quarter-finals</strong>
              <div class="text-soft">Centre Court &middot; 13:00</div>
            </div>
            <div class="schedule-row__note">Ticketed</div>
          </div>
          <div class="schedule-row">
            <div class="schedule-row__date">Sat 17 Oct</div>
            <div>
              <strong>Semi-finals &amp; club team finals</strong>
              <div class="text-soft">Centre Court &middot; 14:00</div>
            </div>
            <div class="schedule-row__note">Ticketed</div>
          </div>
          <div class="schedule-row">
            <div class="schedule-row__date">Sun 19 Oct</div>
            <div>
              <strong>Finals &amp; presentation</strong>
              <div class="text-soft">Centre Court &middot; 15:00</div>
            </div>
            <div class="schedule-row__note">Sold out</div>
          </div>
          <!-- endforeach -->
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== HOW TO ENTER ==================== -->
  <section class="section section--ink">
    <div class="container-xl">
      <div class="row g-5">
        <div class="col-lg-5">
          <span class="eyebrow">Entries</span>
          <h2>How to enter</h2>
          <p class="lede mt-3">Three steps, ten minutes. Entries are reviewed within two working days.</p>
          <a href="{{ route('tennis_registration') }}" class="btn btn-outline-paper mt-3">Start registration</a>
        </div>
        <div class="col-lg-7">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="numbered">I</div>
              <h3 class="mt-2 h5">Register the team</h3>
              <p class="text-soft">Club name, captain and contact details.</p>
            </div>
            <div class="col-md-4">
              <div class="numbered">II</div>
              <h3 class="mt-2 h5">Add the players</h3>
              <p class="text-soft">Name, grade and ranking for every member.</p>
            </div>
            <div class="col-md-4">
              <div class="numbered">III</div>
              <h3 class="mt-2 h5">Confirm the entry</h3>
              <p class="text-soft">Pay the fee and receive the draw position.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== VENUE ==================== -->
  <section class="section section--paper">
    <div class="container-xl">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <span class="eyebrow">The venue</span>
          <h2>Senayan Courts,<br>Jakarta</h2>
          <p class="lede mt-3">
            Twelve grass courts, cut to eight millimetres each morning, with a 4,000-seat centre court
            built for the 1974 championship and restored in 2019.
          </p>
          <hr class="rule my-4">
          <div class="row g-4">
            <div class="col-sm-6">
              <span class="eyebrow eyebrow--muted mb-1">Address</span>
              <p class="mb-0">Jl. Pintu Satu Senayan<br>Jakarta Pusat 10270</p>
            </div>
            <div class="col-sm-6">
              <span class="eyebrow eyebrow--muted mb-1">Tournament office</span>
              <p class="mb-0">entries@grandstandopen.id<br>+62 21 5555 0110</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card-flat">
            <div class="card-body">
              <span class="eyebrow">Latest result</span>
              <h3 class="mb-3">Quarter-final &mdash; Centre Court</h3>
              <ul class="member-list">
                <li><span><strong>A. Wijaya</strong> (1)</span><span>6&ndash;4 7&ndash;5</span></li>
                <li><span>M. Prasetyo (8)</span><span>&mdash;</span></li>
              </ul>
              <a href="{{ route('tennis_bracket') }}" class="collapse-toggle d-inline-block mt-3">See the full draw &rarr;</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
