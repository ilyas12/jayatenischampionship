@extends('tennis.layout')

@section('title', 'Register — Grandstand Open 2026')
@section('description', 'Enter the Grandstand Open 2026. Register your team, add your players and confirm your place in the draw.')

@section('content')

  <!-- ==================== PAGE HEAD ==================== -->
  <section class="section section--tight">
    <div class="container-xl">
      <nav aria-label="Breadcrumb" class="mb-4">
        <span class="eyebrow eyebrow--muted mb-0"><a href="{{ route('tennis_home') }}" class="text-decoration-none text-soft">Tournament</a> &nbsp;/&nbsp; Registration</span>
      </nav>
      <div class="row g-4 align-items-end">
        <div class="col-lg-7">
          <h1 class="mb-0">Enter the<br>championship</h1>
        </div>
        <div class="col-lg-5">
          <p class="lede mb-0">
            One form per team. Singles players register as a team of one.
            Entries close <strong>28 September 2026</strong> or when a draw is full.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== FORM ==================== -->
  <section class="section section--paper pt-0" style="padding-top:0">
    <div class="container-xl">
      <div class="row g-5 pt-5">

        <div class="col-lg-8">
          <!-- Blade: <form method="POST" action=" route('registration.store') " ...> csrf -->
          <form id="registrationForm" class="needs-validation" method="post"
                action="{{ route('event_register', 'grandstand-open-2026') }}" novalidate>
            @csrf
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
              </div>
            @endif

            <!-- ---------- 1. Event ---------- -->
            <div class="fieldset-head">
              <span class="eyebrow">Step one</span>
              <h2 class="h3 mb-0">The event</h2>
            </div>

            <div class="row g-4 mt-1">
              <div class="col-md-6">
                <label for="category" class="form-label">Category <span aria-hidden="true">*</span></label>
                <!-- Blade: foreach (categories as c) <option value=" c->id " selected(old('category_id') == c->id)> c->name </option> endforeach -->
                <select class="form-select" id="category" name="category_id" required>
                  <option value="" selected disabled>Choose a category&hellip;</option>
                  <option value="ms">Men&rsquo;s Singles</option>
                  <option value="ws">Women&rsquo;s Singles</option>
                  <option value="md">Men&rsquo;s Doubles</option>
                  <option value="wd">Women&rsquo;s Doubles</option>
                  <option value="xd">Mixed Doubles</option>
                  <option value="ct">Club Teams</option>
                </select>
                <div class="invalid-feedback">Please choose a category.</div>
              </div>
              <div class="col-md-6">
                <label for="grade" class="form-label">Grade <span aria-hidden="true">*</span></label>
                <select class="form-select" id="grade" name="grade" required>
                  <option value="" selected disabled>Choose a grade&hellip;</option>
                  <option value="open">Open</option>
                  <option value="a">Division A</option>
                  <option value="b">Division B</option>
                  <option value="junior">Junior (U18)</option>
                  <option value="veteran">Veteran (35+)</option>
                </select>
                <div class="invalid-feedback">Please choose a grade.</div>
              </div>
            </div>

            <!-- ---------- 2. Team ---------- -->
            <div class="fieldset-head">
              <span class="eyebrow">Step two</span>
              <h2 class="h3 mb-0">The team</h2>
            </div>

            <div class="row g-4 mt-1">
              <div class="col-md-8">
                <label for="team_name" class="form-label">Team or club name <span aria-hidden="true">*</span></label>
                <!-- Blade: value=" old('team_name') " error('team_name') is-invalid enderror -->
                <input type="text" class="form-control" id="team_name" name="team_name" placeholder="e.g. Senayan Racquet Club" required value="{{ old('team_name') }}">
                <div class="invalid-feedback">A team name is required.</div>
              </div>
              <div class="col-md-4">
                <label for="team_short" class="form-label">Short code</label>
                <input type="text" class="form-control" id="team_short" name="team_short" maxlength="4" placeholder="SRC" value="{{ old('team_short') }}">
                <div class="form-text">Up to four letters, shown on the draw.</div>
              </div>
              <div class="col-md-6">
                <label for="city" class="form-label">City <span aria-hidden="true">*</span></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Jakarta" required value="{{ old('city') }}">
                <div class="invalid-feedback">Please enter a city.</div>
              </div>
              <div class="col-md-6">
                <label for="founded" class="form-label">Club founded</label>
                <input type="number" class="form-control" id="founded" name="founded" min="1850" max="2026" placeholder="1988" value="{{ old('founded') }}">
              </div>
              <div class="col-12">
                <label for="notes" class="form-label">Notes for the referee</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Scheduling requests, accessibility needs, travelling distance&hellip;">{{ old('notes') }}</textarea>
              </div>
            </div>

            <!-- ---------- 3. Captain ---------- -->
            <div class="fieldset-head">
              <span class="eyebrow">Step three</span>
              <h2 class="h3 mb-0">Captain &amp; contact</h2>
            </div>

            <div class="row g-4 mt-1">
              <div class="col-md-6">
                <label for="captain_name" class="form-label">Full name <span aria-hidden="true">*</span></label>
                <input type="text" class="form-control" id="captain_name" name="captain_name" required value="{{ old('captain_name') }}">
                <div class="invalid-feedback">Please enter the captain&rsquo;s name.</div>
              </div>
              <div class="col-md-6">
                <label for="captain_email" class="form-label">Email <span aria-hidden="true">*</span></label>
                <input type="email" class="form-control" id="captain_email" name="captain_email" placeholder="name@club.id" required value="{{ old('captain_email') }}">
                <div class="invalid-feedback">Please enter a valid email address.</div>
              </div>
              <div class="col-md-6">
                <label for="captain_phone" class="form-label">Mobile <span aria-hidden="true">*</span></label>
                <input type="tel" class="form-control" id="captain_phone" name="captain_phone" placeholder="+62 812 0000 0000" required value="{{ old('captain_phone') }}">
                <div class="invalid-feedback">Please enter a contact number.</div>
              </div>
              <div class="col-md-6">
                <label for="captain_id" class="form-label">Federation ID</label>
                <input type="text" class="form-control" id="captain_id" name="captain_id" placeholder="PELTI-000000" value="{{ old('captain_id') }}">
              </div>
            </div>

            <!-- ---------- 4. Members ---------- -->
            <div class="fieldset-head">
              <span class="eyebrow">Step four</span>
              <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
                <h2 class="h3 mb-0">Players</h2>
                <span class="text-soft small">Minimum 1 &middot; maximum 8</span>
              </div>
            </div>

            <!-- Blade: foreach (old('members', team->members ?? [[]]) as i => member) ... endforeach -->
            <div id="memberList" class="mt-4">
              <div class="member-row" data-member>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="member-row__no">Player <span data-member-no>1</span></span>
                  <button type="button" class="btn-remove" data-remove-member>Remove</button>
                </div>
                <div class="row g-3">
                  <div class="col-md-5">
                    <label class="form-label">Full name <span aria-hidden="true">*</span></label>
                    <input type="text" class="form-control" name="members[0][name]" required>
                    <div class="invalid-feedback">Required.</div>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Date of birth</label>
                    <input type="date" class="form-control" name="members[0][dob]">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">Rank</label>
                    <input type="number" class="form-control" name="members[0][rank]" min="1" placeholder="42">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="members[0][role]">
                      <option value="player">Player</option>
                      <option value="captain">Captain</option>
                      <option value="reserve">Reserve</option>
                      <option value="coach">Coach</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" class="btn btn-outline-ink btn-sm mt-2" id="addMember">+ Add player</button>

            <!-- ---------- 5. Confirm ---------- -->
            <div class="fieldset-head">
              <span class="eyebrow">Step five</span>
              <h2 class="h3 mb-0">Confirm</h2>
            </div>

            <div class="mt-4">
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rules" name="accept_rules" value="1" required>
                <label class="form-check-label" for="rules">
                  Every listed player has read and accepts the
                  <a href="#rulesModal" data-bs-toggle="modal" data-bs-target="#rulesModal">tournament rules and code of conduct</a>.
                </label>
                <div class="invalid-feedback">You must accept the rules to enter.</div>
              </div>
              <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="media" name="accept_media" value="1">
                <label class="form-check-label" for="media">
                  We consent to photography and results being published on the tournament site.
                </label>
              </div>

              <div class="d-flex flex-wrap gap-3">
                <button type="submit" class="btn btn-ink">Submit entry</button>
                <button type="reset" class="btn btn-outline-ink">Clear form</button>
              </div>
              <p class="form-text mt-3 mb-0">You will receive confirmation within two working days.</p>
            </div>

          </form>
        </div>

        <!-- ---------- summary ---------- -->
        <div class="col-lg-4">
          <aside class="summary-card">
            <span class="eyebrow">Entry summary</span>
            <dl class="mb-0 mt-3">
              <dt>Entry fee</dt>
              <dd>Rp 750.000 per singles entry &middot; Rp 1.200.000 per team</dd>
              <dt>Entries close</dt>
              <dd>28 September 2026, 23:59 WIB</dd>
              <dt>Draw published</dt>
              <dd>5 October 2026</dd>
              <dt>Withdrawals</dt>
              <dd>Full refund until 1 October, none after.</dd>
            </dl>
            <hr class="rule my-4" style="opacity:.25">
            <p class="mb-0 small">Questions? <a href="mailto:entries@grandstandopen.id" class="text-decoration-underline" style="color:#fff">entries@grandstandopen.id</a></p>
          </aside>
        </div>

      </div>
    </div>
  </section>


@include('tennis.partials.rules-modal')
@endsection
