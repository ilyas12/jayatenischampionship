<!-- Sliced from tennis/index.html, byte-identical across all four pages. -->
<footer class="site-footer">
  <div class="container-xl">
    <div class="row g-5">
      <div class="col-lg-4">
        <h4>Grandstand Open</h4>
        <p class="mb-0" style="max-width:38ch">An open championship held every October at the Senayan Courts since 1974.</p>
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
        <p class="mb-1"><a href="mailto:entries@grandstandopen.id">entries@grandstandopen.id</a></p>
        <p class="mb-0">Jl. Pintu Satu Senayan, Jakarta Pusat 10270</p>
      </div>
    </div>
    <div class="footer-bottom d-flex flex-wrap justify-content-between gap-2">
      <span>&copy; 2026 Grandstand Open. All rights reserved.</span>
      <span>Design template &mdash; ready for Laravel Blade.</span>
    </div>
  </div>
</footer>
