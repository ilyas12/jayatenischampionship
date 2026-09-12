<!-- Sliced from tennis/index.html, byte-identical across all four pages. -->
<footer class="site-footer">
  <div class="container-xl">
    <div class="row g-5">
      <div class="col-lg-4">
        {{-- The club crest belongs to the organiser; the JC mark in the header
             belongs to the championship itself. --}}
        <img class="footer-crest"
             src="{{ \terre\Libraries\Asset::v('resources/assets/tennis/img/brand/hjtc-crest.png') }}"
             alt="HIPMI Jaya Tennis Club" width="360" height="360">
        <h4>Jaya Tennis Championship</h4>
        <p class="mb-0" style="max-width:38ch">Hosted by HIPMI Jaya Tennis Club at the Senayan Courts.</p>
      </div>
      <div class="col-6 col-lg-2">
        <span class="eyebrow">Tournament</span>
        <ul class="footer-nav">
          <li><a href="{{ route('tennis_home') }}">Overview</a></li>
          <li><a href="{{ route('tennis_home') }}#schedule">Schedule</a></li>
          <li><a href="{{ route('tennis_bracket') }}">Draw</a></li>
          <li><a href="{{ route('tennis_teams') }}">Teams</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <span class="eyebrow">Players</span>
        <ul class="footer-nav">
          <li><a href="{{ route('tennis_registration') }}">Register</a></li>
          <li><a href="#">Rules &amp; conduct</a></li>
          <li><a href="#">Ranking list</a></li>
          <li><a href="#">Officials</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <span class="eyebrow">Tournament office</span>
        <p class="mb-1"><a href="mailto:entries@jayatennis.id">entries@jayatennis.id</a></p>
        <p class="mb-0">Jl. Pintu Satu Senayan, Jakarta Pusat 10270</p>
      </div>
    </div>
    <div class="footer-bottom d-flex flex-wrap justify-content-between gap-2">
      <span>&copy; 2026 Jaya Tennis Championship. All rights reserved.</span>
    </div>
  </div>
</footer>
