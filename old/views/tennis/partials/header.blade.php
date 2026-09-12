<!-- Sliced from tennis/index.html. Identical across all four pages, so it lives here once. tennisActive marks the current nav item. -->
<header class="site-header">
  <div class="container-xl">
    <nav class="navbar navbar-expand-lg p-0" aria-label="Main navigation">

      <a class="brand" href="{{ route('tennis_home') }}">
        <img class="brand__mark" src="{{ \terre\Libraries\Asset::v('resources/assets/tennis/img/brand/jc-mark.png') }}"
             alt="" width="320" height="320">
        <span>
          <span class="brand__word">Jaya Tennis Championship</span>
          <span class="brand__sub">HIPMI Jaya Tennis Club &middot; Jakarta</span>
        </span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
              aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-bars"><i></i><i></i><i></i></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-lg-auto my-3 my-lg-0 site-nav">
          <li class="nav-item"><a class="nav-link {{ ($tennisActive ?? '') === 'home' ? 'active' : '' }}" href="{{ route('tennis_home') }}">Overview</a></li>
          <li class="nav-item"><a class="nav-link {{ ($tennisActive ?? '') === 'teams' ? 'active' : '' }}" href="{{ route('tennis_teams') }}">Teams</a></li>
          <li class="nav-item"><a class="nav-link {{ ($tennisActive ?? '') === 'bracket' ? 'active' : '' }}" href="{{ route('tennis_bracket') }}">Draw</a></li>
          <li class="nav-item"><a class="nav-link {{ ($tennisActive ?? '') === 'schedule' ? 'active' : '' }}" href="{{ route('tennis_schedule') }}">Schedule</a></li>
        </ul>
        <a href="{{ route('tennis_registration') }}" class="btn btn-purple ms-lg-4 mb-3 mb-lg-0">Register</a>
      </div>

    </nav>
  </div>
</header>
