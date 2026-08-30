#!/usr/bin/env bash
#
# Regression check for the Jaya Tennis Championship site and the CMS it runs on.
#
# The Dua Sisi money changer and Swarnadwipa themes also live in this repo but
# are not covered here: they are separate sites, and their pages were failing
# the tennis suite for reasons that have nothing to do with it.
#
#   ./scripts/smoke-test.sh [base-url]
#
# No pipefail: several checks are `curl ... | grep -q`, and grep -q exits on the
# first match, which SIGPIPEs curl. With pipefail that non-zero curl status
# fails the whole pipeline, so a check reports "missing" precisely when the
# thing it looks for appears early in a large response.
set -u

BASE="${1:-http://localhost:8088}"
PASS=0
FAIL=0
COOKIES="$(mktemp)"
BODY="$(mktemp)"
trap 'rm -f "$COOKIES" "$BODY"' EXIT

ok()   { printf '  \033[32mPASS\033[0m  %s\n' "$1"; PASS=$((PASS + 1)); }
bad()  { printf '  \033[31mFAIL\033[0m  %s\n' "$1"; FAIL=$((FAIL + 1)); }
head_() { printf '\n\033[1m%s\033[0m\n' "$1"; }

# The admin panel lives behind an obfuscated prefix in routes/web.php. Read it
# from the source so this keeps working if the routes are restructured.
ADMIN_PREFIX="$(grep -oE "'prefix'[[:space:]]*=>[[:space:]]*'[^']+'" routes/web.php 2>/dev/null \
    | head -1 | sed "s/.*'\\([^']*\\)'$/\\1/")"
: "${ADMIN_PREFIX:=_d50d0608e7c3270b3f0e3753f996387b}"

status() { curl -s -o "$BODY" -w '%{http_code}' --max-time 30 "$1"; }

expect() { # url expected-code label
    local got
    got="$(status "$1")"
    if [ "$got" = "$2" ]; then ok "$3 ($got)"; else bad "$3 — expected $2, got $got"; fi
}

# Same as expect(), but sends the session cookie so admin routes are reached as
# a logged-in user rather than being bounced to the login screen.
expect_auth() { # url expected-code label
    local got
    got="$(curl -s -b "$COOKIES" -o "$BODY" -w '%{http_code}' --max-time 30 "$1")"
    if [ "$got" = "$2" ]; then ok "$3 ($got)"; else bad "$3 — expected $2, got $got"; fi
}

head_ "Teams from the CMS"
# The homepage carries a clubs strip that links into the teams page.
if curl -s --max-time 30 "$BASE/" | grep -qE 'club-tile|No clubs have entered'; then
    ok "homepage clubs strip renders or explains itself"
else
    bad "homepage clubs strip missing"
fi

if curl -s --max-time 30 "$BASE/teams" | grep -q 'id="teamGrid"'; then
    ok "teams grid renders"
else
    bad "teams grid missing"
fi
if curl -s --max-time 30 "$BASE/teams" | grep -qE 'teamCount">[0-9]+'; then
    ok "team count is rendered from the data"
else
    bad "team count not rendered"
fi

# Cards link to a detail page keyed on the team's permalink.
TEAM_URL="$(curl -s --max-time 30 "$BASE/teams" \
    | grep -oE 'href="[^"]*/teams/[a-z0-9-]+"' | head -1 | sed 's/href="//;s/"$//')"
if [ -n "$TEAM_URL" ]; then
    case "$TEAM_URL" in http*) ;; *) TEAM_URL="$BASE$TEAM_URL" ;; esac
    expect "$TEAM_URL" 200 "team detail page"
else
    bad "no team detail link on the teams page"
fi
expect "$BASE/teams/no-such-team" 404 "unknown team returns 404"

# Draw and results read event_matches, but what they show depends on the event
# phase — in registration there is deliberately no bracket. The page must still
# be reachable and must explain itself rather than render blank.
head_ "Draw and results"
DRAW_BODY="$(curl -s --max-time 30 "$BASE/draw")"
expect "$BASE/draw" 200 "draw page is reachable in every phase"

if printf '%s' "$DRAW_BODY" | grep -q 'class="round__title"'; then
    ok "bracket rounds render"
    if printf '%s' "$DRAW_BODY" | grep -q 'data-draw-panel'; then
        ok "draw renders a bracket panel per category"
    else
        bad "draw category panels missing"
    fi
elif printf '%s' "$DRAW_BODY" | grep -q 'phase-notice'; then
    ok "no draw yet — the page explains the phase instead of rendering blank"
else
    bad "draw page has neither a bracket nor a phase notice"
fi

if printf '%s' "$DRAW_BODY" | grep -qE 'board__winner|phase-notice'; then
    ok "results board shows played ties or says why it is empty"
else
    bad "results board is blank with no explanation"
fi

# Event registration flow, end to end: submit -> payment page -> proof upload.
# Needs the grandstand-open-2026 event seeded; skips cleanly if it is not.
head_ "Event registration flow"
REG_COOKIES="$(mktemp)"
REG_TOKEN="$(curl -s -c "$REG_COOKIES" --max-time 30 "$BASE/registration" \
    | grep -oE 'name="_token" value="[^"]*"' | head -1 | sed 's/.*value="//;s/"//')"
REG_LOC="$(curl -s -b "$REG_COOKIES" -c "$REG_COOKIES" -o /dev/null -w '%{redirect_url}' --max-time 30 \
    -X POST "$BASE/event/grandstand-open-2026/register" \
    -d "_token=$REG_TOKEN" \
    -d "captain_name=Smoke Test" -d "captain_email=smoke@test.local" -d "captain_phone=0800000000" \
    -d "category_id=ct" -d "grade=open" -d "team_name=Smoke FC" \
    -d "members[0][name]=Smoke Player" -d "accept_rules=1")"

case "$REG_LOC" in
    */event/payment/*)
        ok "registration POST redirects to its payment page"
        REG_CODE="${REG_LOC##*/}"
        expect "$BASE/event/payment/$REG_CODE" 200 "payment page for $REG_CODE"
        if curl -s -b "$REG_COOKIES" --max-time 30 "$BASE/event/payment/$REG_CODE" | grep -q "$REG_CODE"; then
            ok "payment page shows the reference code"
        else
            bad "payment page does not show the reference code"
        fi
        ;;
    *)
        printf '  \033[33mSKIP\033[0m  registration flow — no redirect (is the event seeded and open?)\n'
        ;;
esac
rm -f "$REG_COOKIES"

# The suite creates a real registration every run. Delete it again, or the admin
# list fills up with test entries. Keyed on the code it just received, so a run
# only ever removes its own row. Skipped when the database is not reachable —
# the flow above still works against a remote environment, the tidy-up does not.
if [ -n "${REG_CODE:-}" ] && docker compose ps db >/dev/null 2>&1; then
    if docker compose exec -T db mysql -ucms -psecret cms_template_engine \
        -e "DELETE FROM terre217_event_registrations WHERE code = '${REG_CODE}';" >/dev/null 2>&1; then
        ok "cleaned up its own registration ($REG_CODE)"
    else
        bad "could not delete registration $REG_CODE — it will linger in the admin list"
    fi
fi

# Grandstand Open — static slice of the tennis mockup.
head_ "Tennis site (site root)"
for path in "" teams draw schedule registration; do
    expect "$BASE/$path" 200 "GET /$path"
done
for asset in css/style.css js/main.js img/teams/src.svg img/players/player-serve.jpg img/players/player-forehand.jpg; do
    expect "$BASE/resources/assets/tennis/$asset" 200 "GET tennis asset $asset"
done
# The rules modal lives after </main> in the source and was missed by the first
# extraction; assert it is actually on the page.
if curl -s --max-time 30 "$BASE/registration" | grep -q 'id="rulesModal"'; then
    ok "registration page includes the rules modal"
else
    bad "registration page is missing the rules modal"
fi

head_ "Error handling"
expect "$BASE/this-route-does-not-exist-$$" 404 "unknown route returns 404"
if curl -s --max-time 30 "$BASE/this-route-does-not-exist-$$" \
    | grep -qiE "(Fatal error|must be compatible with|ReflectionException)"; then
    bad "the 404 page reports a PHP fatal — the exception handler is broken"
else
    ok "404 renders through the exception handler cleanly"
fi

head_ "Admin authentication"
expect "$BASE/$ADMIN_PREFIX/login" 200 "GET admin login"

TOKEN="$(curl -s -c "$COOKIES" --max-time 30 "$BASE/$ADMIN_PREFIX/login" \
    | grep -oE 'name="_token"[^>]*value="[^"]*"' | head -1 \
    | sed 's/.*value="//;s/"$//')"
if [ -n "$TOKEN" ]; then
    ok "login form issues a CSRF token (sessions are writable)"
else
    bad "no CSRF token in the login form — sessions or storage/ are broken"
fi

# A wrong password must redirect back, not 500. This exercises the session,
# the DB query and the bcrypt check in one request.
CODE="$(curl -s -b "$COOKIES" -c "$COOKIES" -o "$BODY" -w '%{http_code}' --max-time 30 \
    -X POST "$BASE/$ADMIN_PREFIX/login/dologin" \
    -d "_token=$TOKEN" -d "email=admin@admin.com" -d "password=wrong-on-purpose-$$")"
if [ "$CODE" = "302" ] || [ "$CODE" = "200" ]; then
    ok "bad-password login handled gracefully ($CODE)"
else
    bad "bad-password login returned $CODE — expected 302/200"
fi

# Seeded by scripts/seed-test-admin.sh. Without it the authenticated section is
# skipped rather than failed, so the script still works against environments
# that have no test account.
head_ "Admin panel (authenticated)"
LOGIN_CODE="$(curl -s -b "$COOKIES" -c "$COOKIES" -o /dev/null -w '%{http_code}' --max-time 30 \
    -X POST "$BASE/$ADMIN_PREFIX/login/dologin" \
    -d "_token=$TOKEN" -d "email=smoke@test.local" -d "password=smoketest123")"

if curl -s -b "$COOKIES" --max-time 30 "$BASE/$ADMIN_PREFIX/setting" | grep -q "<form"; then
    ok "logged in as the test admin ($LOGIN_CODE)"

    # Log in a second time with a fresh session. Laravel 11+ rehashes the
    # password during a successful login, so a bug in the password mutator
    # corrupts the stored hash on the FIRST login and only shows up on the
    # second. A single login attempt cannot catch that class of bug.
    COOKIES2="$(mktemp)"
    TOKEN2="$(curl -s -c "$COOKIES2" --max-time 30 "$BASE/$ADMIN_PREFIX/login" \
        | grep -oE 'name="_token"[^>]*value="[^"]*"' | head -1 | sed 's/.*value="//;s/"$//')"
    curl -s -b "$COOKIES2" -c "$COOKIES2" -o /dev/null --max-time 30 \
        -X POST "$BASE/$ADMIN_PREFIX/login/dologin" \
        -d "_token=$TOKEN2" -d "email=smoke@test.local" -d "password=smoketest123"

    if curl -s -b "$COOKIES2" --max-time 30 "$BASE/$ADMIN_PREFIX/setting" | grep -q "<form"; then
        ok "second login still works — the stored password hash survived the first"
    else
        bad "second login failed — the first login corrupted the password hash"
    fi
    rm -f "$COOKIES2"

    # These pages between them exercise every Form:: helper the app uses:
    # open/close, text, textarea, select, label, checkbox, radio and hidden.
    for path in setting about news-and-event administrator location contact_address; do
        expect_auth "$BASE/$ADMIN_PREFIX/$path" 200 "GET admin /$path"
    done

    for path in setting about administrator; do
        if curl -s -b "$COOKIES" --max-time 30 "$BASE/$ADMIN_PREFIX/$path" \
            | grep -qiE "(Fatal error|Parse error|Whoops, looks like something went wrong)"; then
            bad "admin /$path renders a PHP error"
        else
            ok "admin /$path renders without PHP errors"
        fi
    done
else
    printf '  \033[33mSKIP\033[0m  admin panel — no smoke@test.local account (run scripts/seed-test-admin.sh)\n'
fi

head_ "Application internals must not be reachable over HTTP"
for path in .env vendor/autoload.php app/User.php composer.json cms-template-engine.sql resources/views; do
    expect "$BASE/$path" 403 "GET /$path is denied"
done

# The admin upload path resizes every image through Imagine. It is not
# reachable over plain HTTP without posting a multipart upload, so exercise the
# same call chain directly in the container instead.
head_ "Image pipeline (Imagine thumbnail + effects)"
IMG_SRC="$(find resources/assets/uploads -name '*.jpg' 2>/dev/null | head -1)"
if [ -n "$IMG_SRC" ] && docker compose ps app >/dev/null 2>&1; then
    IMG_RESULT="$(docker compose exec -T app php -r '
        require "vendor/autoload.php";
        $app = require_once "bootstrap/app.php";
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $out = "/tmp/smoke-thumb.jpg";
        @unlink($out);
        Image::open($argv[1])->thumbnail(new Imagine\Image\Box(150, 150))->save($out);
        $fx = Image::open($argv[1])->thumbnail(new Imagine\Image\Box(80, 80));
        $fx->effects()->colorize(Image::open($argv[1])->palette()->color("#336699"));
        $fx->effects()->blur(1);
        $fx->effects()->grayscale();
        $fx->save("/tmp/smoke-fx.jpg");
        echo (file_exists($out) && file_exists("/tmp/smoke-fx.jpg")) ? "OK" : "FAILED";
    ' "$IMG_SRC" 2>&1 | tail -1)"

    if [ "$IMG_RESULT" = "OK" ]; then
        ok "thumbnail and effects chain produce output"
    else
        bad "image pipeline failed: $IMG_RESULT"
    fi
else
    printf '  \033[33mSKIP\033[0m  image pipeline — no sample upload or container not running\n'
fi

head_ "No PHP errors leaking into responses"
LEAK=0
for path in "" teams draw schedule registration; do
    if curl -s --max-time 30 "$BASE/$path" \
        | grep -qiE "(Fatal error|Parse error|Warning</b>|Notice</b>|Whoops, looks like something went wrong|Deprecated:)"; then
        bad "/$path renders a PHP error or Whoops page"
        LEAK=1
    fi
done
[ "$LEAK" -eq 0 ] && ok "no PHP errors or Whoops pages in any public response"

printf '\n\033[1mResult:\033[0m %d passed, %d failed\n' "$PASS" "$FAIL"
[ "$FAIL" -eq 0 ] || exit 1
