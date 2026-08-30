<!-- Sliced from tennis/index.html. Identical across all four pages, so it lives here once. tennisActive marks the current nav item. -->
<header class="site-header">
  <div class="container-xl">
    <nav class="navbar navbar-expand-lg p-0" aria-label="Main navigation">

      <a class="brand" href="{{ route('tennis_home') }}">
        <svg class="brand__mark" viewBox="0 0 40 40" aria-hidden="true">
          <circle cx="20" cy="20" r="18" fill="#0A4A2A"/>
          <path d="M6 8c8 6 8 18 0 24M34 8c-8 6-8 18 0 24" fill="none" stroke="#D8E64A" stroke-width="2"/>
        </svg>
        <span>
          <span class="brand__word">Grandstand Open</span>
          <span class="brand__sub">Est. 1974 &middot; Jakarta</span>
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
