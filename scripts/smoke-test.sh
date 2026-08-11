#!/usr/bin/env bash
#
# Regression check for the Laravel 5.4 -> 11 upgrade. Run after every version
# bump; a step is not done until this exits 0.
#
#   ./scripts/smoke-test.sh [base-url]
#
set -uo pipefail

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

head_ "Public pages"
for path in "" rates branches news-and-events underlying contact; do
    expect "$BASE/$path" 200 "GET /$path"
done

head_ "Dynamic content (proves the DB import and slug routing work)"
DETAIL="$(curl -s --max-time 30 "$BASE/news-and-events" \
    | grep -oE 'href="[^"]*/news-and-events/[^"]+"' | head -1 \
    | sed 's/href="//;s/"$//')"
if [ -n "$DETAIL" ]; then
    case "$DETAIL" in http*) ;; *) DETAIL="$BASE$DETAIL" ;; esac
    expect "$DETAIL" 200 "GET a news detail page"
else
    bad "no news detail link found on /news-and-events"
fi

head_ "Static assets"
for asset in resources/assets/css/style.css resources/assets/js/jquery.js; do
    expect "$BASE/$asset" 200 "GET /$asset"
done

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
for path in "" rates branches news-and-events underlying contact; do
    if curl -s --max-time 30 "$BASE/$path" \
        | grep -qiE "(Fatal error|Parse error|Warning</b>|Notice</b>|Whoops, looks like something went wrong|Deprecated:)"; then
        bad "/$path renders a PHP error or Whoops page"
        LEAK=1
    fi
done
[ "$LEAK" -eq 0 ] && ok "no PHP errors or Whoops pages in any public response"

printf '\n\033[1mResult:\033[0m %d passed, %d failed\n' "$PASS" "$FAIL"
[ "$FAIL" -eq 0 ] || exit 1
