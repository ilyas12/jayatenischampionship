@php $active = $active ?? ''; @endphp

<footer class="jtc__footer">
  <div class="jtc__container">

    <div class="jtc__footer-top">
      <a class="jtc__footer-logo" href="{{ route('jtc_home') }}">
        <img src="{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_logo_light.png') }}"
             alt="Jaya Tennis Championship" width="126" height="81">
      </a>

      <nav class="jtc__footer-nav" aria-label="Footer">
        <a class="{{ $active === 'jtc_home' ? 'is-active' : '' }}" href="{{ route('jtc_home') }}">Home</a>
        <a class="{{ $active === 'jtc_past_winners' ? 'is-active' : '' }}" href="{{ route('jtc_past_winners') }}">Past Winner</a>
        <a class="{{ $active === 'jtc_schedule' ? 'is-active' : '' }}" href="{{ route('jtc_schedule') }}">Schedule</a>
        <a class="{{ $active === 'jtc_draw' ? 'is-active' : '' }}" href="{{ route('jtc_draw') }}">Draw</a>
        <a class="{{ $active === 'jtc_register' ? 'is-active' : '' }}" href="{{ route('jtc_register') }}">Register</a>
      </nav>

      {{-- ponytail: real handles once they exist; these are the PSD's icons. --}}
      <div class="jtc__social">
        <a href="#" aria-label="Instagram">@include('jtc.partials.jtc_icon', ['name' => 'instagram', 'size' => 20])</a>
        <a href="#" aria-label="YouTube">@include('jtc.partials.jtc_icon', ['name' => 'youtube', 'size' => 20])</a>
        <a href="#" aria-label="LinkedIn">@include('jtc.partials.jtc_icon', ['name' => 'linkedin', 'size' => 18])</a>
      </div>
    </div>

    <div class="jtc__footer-bottom">
      <p>&copy; {{ date('Y') }} Jaya Tennis Championship. All rights reserved.</p>
      <p class="jtc__legal">
        <a href="#">Privacy Policy</a><span>|</span>
        <a href="#">Terms &amp; Conditions</a><span>|</span>
        <a href="#">Contact</a>
      </p>
    </div>

  </div>
</footer>
