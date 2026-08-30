@extends('tennis.layout')

@section('title', 'Teams &amp; Players — Grandstand Open 2026')
@section('description', 'The sixteen clubs and their registered players for the Grandstand Open 2026.')

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
            Eight clubs confirmed for the team championship, with every registered player
            and their national ranking. Lists lock on 5 October.
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
          <button type="button" class="filter-btn" data-filter="a">Group A</button>
          <button type="button" class="filter-btn" data-filter="b">Group B</button>
          <button type="button" class="filter-btn" data-filter="qualified">Qualified</button>
        </div>
        <span class="text-soft small"><span id="teamCount">8</span> teams &middot; <span id="playerCount">34</span> players</span>
      </div>

      <div class="row g-4" id="teamGrid">

        <!-- Blade: foreach (teams as team) ... endforeach -->
        <div class="col-md-6 col-xl-4" data-group="a qualified">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/src.svg') }}" alt="Senayan Racquet Club squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest">SRC</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Senayan Racquet Club</h3>
                <div class="text-soft small">Jakarta &middot; est. 1974</div>
              </div>
              <div class="mb-3"><span class="tag tag--purple">Seed 1</span> <span class="tag">Group A</span></div>
              <p class="text-soft small flex-grow-1">Defending champions, unbeaten in the last two team finals.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-src" role="button" aria-expanded="false" aria-controls="team-src">Players (5) &darr;</a>
              <div class="collapse mt-3" id="team-src">
                <ul class="member-list">
                  <li><span>Arya Wijaya</span><span>Captain &middot; #4</span></li>
                  <li><span>Dimas Hartono</span><span>Player &middot; #17</span></li>
                  <li><span>Reza Kurnia</span><span>Player &middot; #23</span></li>
                  <li><span>Bagas Nugroho</span><span>Player &middot; #41</span></li>
                  <li><span>Yudha Pratama</span><span>Reserve &middot; #88</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="b qualified">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/ykv.svg') }}" alt="Yogyakarta Volley squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest crest--purple">YKV</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Yogyakarta Volley</h3>
                <div class="text-soft small">Yogyakarta &middot; est. 1991</div>
              </div>
              <div class="mb-3"><span class="tag tag--purple">Seed 2</span> <span class="tag">Group B</span></div>
              <p class="text-soft small flex-grow-1">Serve-and-volley side that has taken a set off every seed this season.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-ykv" role="button" aria-expanded="false" aria-controls="team-ykv">Players (4) &darr;</a>
              <div class="collapse mt-3" id="team-ykv">
                <ul class="member-list">
                  <li><span>Sinta Rahayu</span><span>Captain &middot; #6</span></li>
                  <li><span>Nadia Putri</span><span>Player &middot; #12</span></li>
                  <li><span>Fajar Ramadhan</span><span>Player &middot; #29</span></li>
                  <li><span>Tio Saputra</span><span>Reserve &middot; #64</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="a qualified">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/bts.svg') }}" alt="Bali Topspin squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest crest--brass">BTS</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Bali Topspin</h3>
                <div class="text-soft small">Denpasar &middot; est. 2003</div>
              </div>
              <div class="mb-3"><span class="tag tag--purple">Seed 3</span> <span class="tag">Group A</span></div>
              <p class="text-soft small flex-grow-1">Grass-court specialists; the deepest doubles pairing in the draw.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-bts" role="button" aria-expanded="false" aria-controls="team-bts">Players (4) &darr;</a>
              <div class="collapse mt-3" id="team-bts">
                <ul class="member-list">
                  <li><span>Kadek Surya</span><span>Captain &middot; #9</span></li>
                  <li><span>Wayan Adnyana</span><span>Player &middot; #21</span></li>
                  <li><span>Putu Andini</span><span>Player &middot; #33</span></li>
                  <li><span>Gede Mahendra</span><span>Reserve &middot; #77</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="b">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/sbs.svg') }}" alt="Surabaya Smash squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest">SBS</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Surabaya Smash</h3>
                <div class="text-soft small">Surabaya &middot; est. 1986</div>
              </div>
              <div class="mb-3"><span class="tag tag--purple">Seed 4</span> <span class="tag">Group B</span></div>
              <p class="text-soft small flex-grow-1">Runners-up in 2025 after a deciding championship tie-break.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-sbs" role="button" aria-expanded="false" aria-controls="team-sbs">Players (4) &darr;</a>
              <div class="collapse mt-3" id="team-sbs">
                <ul class="member-list">
                  <li><span>Hendra Susanto</span><span>Captain &middot; #11</span></li>
                  <li><span>Rio Alamsyah</span><span>Player &middot; #26</span></li>
                  <li><span>Bayu Ardiansyah</span><span>Player &middot; #38</span></li>
                  <li><span>Galih Permana</span><span>Reserve &middot; #92</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="a">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/kcc.svg') }}" alt="Kemang Court Club squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest crest--purple">KCC</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Kemang Court Club</h3>
                <div class="text-soft small">Jakarta &middot; est. 1998</div>
              </div>
              <div class="mb-3"><span class="tag">Seed 5</span> <span class="tag">Group A</span></div>
              <p class="text-soft small flex-grow-1">Youngest squad in the field, average age twenty-two.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-kcc" role="button" aria-expanded="false" aria-controls="team-kcc">Players (4) &darr;</a>
              <div class="collapse mt-3" id="team-kcc">
                <ul class="member-list">
                  <li><span>Aditya Nugraha</span><span>Captain &middot; #14</span></li>
                  <li><span>Vino Setiawan</span><span>Player &middot; #31</span></li>
                  <li><span>Raka Prabowo</span><span>Player &middot; #47</span></li>
                  <li><span>Ilham Maulana</span><span>Reserve &middot; #103</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="b">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/mas.svg') }}" alt="Medan Ace Society squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest crest--brass">MAS</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Medan Ace Society</h3>
                <div class="text-soft small">Medan &middot; est. 1979</div>
              </div>
              <div class="mb-3"><span class="tag">Seed 6</span> <span class="tag">Group B</span></div>
              <p class="text-soft small flex-grow-1">Biggest servers in the tournament; twelve aces a match on average.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-mas" role="button" aria-expanded="false" aria-controls="team-mas">Players (4) &darr;</a>
              <div class="collapse mt-3" id="team-mas">
                <ul class="member-list">
                  <li><span>Josua Sinaga</span><span>Captain &middot; #19</span></li>
                  <li><span>Rendi Tampubolon</span><span>Player &middot; #35</span></li>
                  <li><span>Marco Siregar</span><span>Player &middot; #52</span></li>
                  <li><span>Andre Panggabean</span><span>Reserve &middot; #110</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="a">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/mkn.svg') }}" alt="Makassar Netcord squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest">MKN</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Makassar Netcord</h3>
                <div class="text-soft small">Makassar &middot; est. 2010</div>
              </div>
              <div class="mb-3"><span class="tag">Seed 7</span> <span class="tag">Group A</span></div>
              <p class="text-soft small flex-grow-1">First appearance in the main draw after winning the eastern qualifier.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-mkn" role="button" aria-expanded="false" aria-controls="team-mkn">Players (4) &darr;</a>
              <div class="collapse mt-3" id="team-mkn">
                <ul class="member-list">
                  <li><span>Fikri Ramli</span><span>Captain &middot; #24</span></li>
                  <li><span>Alif Hidayat</span><span>Player &middot; #44</span></li>
                  <li><span>Danang Wibowo</span><span>Player &middot; #58</span></li>
                  <li><span>Iqbal Mansyur</span><span>Reserve &middot; #121</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4" data-group="b">
          <article class="card-flat team-card">
            <figure class="team-card__photo">
              <!-- Blade: <img src=" team->photo_url " alt=" team->name squad"> -->
              <img src="{{ asset('resources/assets/tennis/img/teams/bbl.svg') }}" alt="Bandung Baseline squad, 2026" width="720" height="480" loading="lazy">
              <span class="crest crest--purple">BBL</span>
            </figure>
            <div class="card-body d-flex flex-column h-100">
              <div class="team-card__head mb-3">
                <h3 class="h5 mb-1">Bandung Baseline</h3>
                <div class="text-soft small">Bandung &middot; est. 1995</div>
              </div>
              <div class="mb-3"><span class="tag">Seed 8</span> <span class="tag">Group B</span></div>
              <p class="text-soft small flex-grow-1">Grinders. No club has played more three-set matches this year.</p>
              <a class="collapse-toggle" data-bs-toggle="collapse" href="#team-bbl" role="button" aria-expanded="false" aria-controls="team-bbl">Players (5) &darr;</a>
              <div class="collapse mt-3" id="team-bbl">
                <ul class="member-list">
                  <li><span>Ergi Firmansyah</span><span>Captain &middot; #27</span></li>
                  <li><span>Salman Rizki</span><span>Player &middot; #49</span></li>
                  <li><span>Wildan Nugraha</span><span>Player &middot; #61</span></li>
                  <li><span>Farhan Alwi</span><span>Player &middot; #73</span></li>
                  <li><span>Zaki Ramadhan</span><span>Reserve &middot; #134</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>

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
