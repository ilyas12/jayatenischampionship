@extends('jtc.jtc_layout')

@section('title', 'Register')
@section('description', 'Register to play in the Jaya Tennis Championship — compete, connect and be part of a growing tennis community.')

@section('content')

  {{-- Two columns the full height of the page: the hero and the details sit
       left, the form panel runs down the right. Below 1100px they stack. --}}
  <div class="jtc__register">

    <div class="jtc__register-main">

      <section class="jtc__register-hero"
               style="background-image: url('{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_hero_register.jpg') }}')">
        <div class="jtc__register-hero-inner">
          <p class="jtc__eyebrow jtc__eyebrow--light">Be part of Jaya Tennis Championship</p>
          <h1 class="jtc__display jtc__display--light">Register<br>to play</h1>
          <p class="jtc__campaign">Compete, connect and be part of<br>a growing tennis community.</p>
        </div>
      </section>

      <div class="jtc__register-body">

        @include('jtc.partials.jtc_facts', ['facts' => $facts])

        <h2 class="jtc__section-heading">Select category</h2>
        <div class="jtc__category-grid">
          @foreach ($categories as $category)
            <label class="jtc__category">
              @include('jtc.partials.jtc_icon', ['name' => 'people', 'size' => 30])
              <span class="jtc__category-name">{{ $category['name'] }}</span>
              <input type="radio" name="category" value="{{ $category['value'] }}" form="jtc-register-form">
              <span class="jtc__category-mark" aria-hidden="true"></span>
            </label>
          @endforeach
        </div>

        <div class="jtc__rule" role="presentation"></div>

        <h2 class="jtc__section-heading">Tournament information</h2>
        <div class="jtc__info-grid">
          @foreach ($information as $item)
            <div class="jtc__info">
              @include('jtc.partials.jtc_icon', ['name' => $item['icon'], 'size' => 28])
              <span>
                <span class="jtc__info-label">{{ $item['label'] }}</span>
                <span class="jtc__info-value">
                  @if (! empty($item['url']))
                    <a class="jtc__link-arrow" href="{{ $item['url'] }}">
                      {{ $item['value'] }} @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 14])
                    </a>
                  @else
                    {{ $item['value'] }}
                  @endif
                </span>
              </span>
            </div>
          @endforeach
        </div>

      </div>
    </div>

    {{-- Registration is not open yet, so the form posts nowhere and the fields
         are disabled. The markup is the real thing: when entries open it needs
         an action and the disabled attributes removed, nothing more. --}}
    <aside class="jtc__form-panel">
      <form id="jtc-register-form" method="post" action="#" novalidate>
        <h2 class="jtc__form-title">Player information</h2>

        <div class="jtc__field">
          <label for="jtc-player-1">Player 1 - Full Name</label>
          <input class="jtc__input" id="jtc-player-1" name="player_1" type="text" placeholder="Enter full name" disabled>
        </div>

        <div class="jtc__field">
          <label for="jtc-player-2">Player 2 - Full Name</label>
          <input class="jtc__input" id="jtc-player-2" name="player_2" type="text" placeholder="Enter full name" disabled>
        </div>

        <div class="jtc__field">
          <label for="jtc-email">Email</label>
          <input class="jtc__input" id="jtc-email" name="email" type="email" placeholder="Enter email address" disabled>
        </div>

        <div class="jtc__field">
          <label for="jtc-whatsapp">WhatsApp Number</label>
          <span class="jtc__phone">
            <select aria-label="Country code" disabled>
              <option>+62</option>
            </select>
            <input class="jtc__input" id="jtc-whatsapp" name="whatsapp" type="tel" placeholder="Enter WhatsApp number" disabled>
          </span>
        </div>

        <div class="jtc__field">
          <label for="jtc-club">Club / Company (Optional)</label>
          <input class="jtc__input" id="jtc-club" name="club" type="text" placeholder="Enter club or company name" disabled>
        </div>

        <label class="jtc__check">
          <input type="checkbox" name="terms" value="1" disabled>
          <span>I have read and agree to the Terms &amp; Conditions</span>
        </label>

        <button class="jtc__btn jtc__btn--solid jtc__btn--block" type="submit" disabled>
          Submit registration @include('jtc.partials.jtc_icon', ['name' => 'arrow-right', 'size' => 18])
        </button>

        <p class="jtc__form-note">Registration will be open soon. Stay tuned for updates.</p>
      </form>
    </aside>

  </div>

@endsection
