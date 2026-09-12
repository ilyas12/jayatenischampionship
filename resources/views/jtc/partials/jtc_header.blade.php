{{--
    Header. $active is the route name of the current page, set by each view, and
    drives the underline the PSD puts under the current item — in the nav and
    again in the footer.
--}}
@php $active = $active ?? ''; @endphp

<header class="jtc__header">
  <div class="jtc__container jtc__header-inner">

    <a class="jtc__logo" href="{{ route('jtc_home') }}">
      <img src="{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_logo_dark.png') }}"
           alt="Jaya Tennis Championship" width="107" height="69">
    </a>

    <button class="jtc__burger" type="button" data-jtc-burger
            aria-label="Menu" aria-expanded="false" aria-controls="jtc-nav">
      @include('jtc.partials.jtc_icon', ['name' => 'menu', 'size' => 22])
    </button>

    <nav class="jtc__nav" id="jtc-nav" data-jtc-nav aria-label="Main">
      <a class="jtc__nav-link {{ $active === 'jtc_home' ? 'is-active' : '' }}" href="{{ route('jtc_home') }}">Home</a>
      <a class="jtc__nav-link {{ $active === 'jtc_past_winners' ? 'is-active' : '' }}" href="{{ route('jtc_past_winners') }}">Past Winner</a>
      <a class="jtc__nav-link {{ $active === 'jtc_schedule' ? 'is-active' : '' }}" href="{{ route('jtc_schedule') }}">Schedule</a>
      <a class="jtc__nav-link {{ $active === 'jtc_draw' ? 'is-active' : '' }}" href="{{ route('jtc_draw') }}">Draw</a>
      <a class="jtc__btn jtc__btn--solid jtc__nav-cta" href="{{ route('jtc_register') }}">Register</a>
    </nav>

  </div>
</header>
