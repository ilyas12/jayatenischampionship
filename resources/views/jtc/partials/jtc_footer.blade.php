@php
    $active  = $active ?? '';
    // Shared by every page, so it is fetched here rather than threaded through
    // five controller methods that otherwise have nothing to do with it.
    $socials = \terre\Http\Models\SocialLinkModel::published();
@endphp

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

      {{-- Accounts from the CMS. A row with no link never reaches here, so
           every icon goes somewhere; the module's FontAwesome class picks the
           mark, and anything this set has no mark for falls back to a link. --}}
      @if (count($socials))
        <div class="jtc__social">
          @foreach ($socials as $social)
            <a href="{{ $social->link }}" target="_blank" rel="noopener me"
               aria-label="{{ $social->name }}{{ $social->username ? ' — ' . $social->username : '' }}">
              @include('jtc.partials.jtc_icon', [
                  'name' => in_array($social->icon_slug, ['instagram','youtube','linkedin','facebook','twitter','tiktok'])
                      ? $social->icon_slug : 'link',
                  'size' => 20,
              ])
            </a>
          @endforeach
        </div>
      @endif
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
