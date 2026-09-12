# CMS Template Engine

The Laravel CMS behind the **Jaya Tennis Championship** — the public tournament
site at the document root, and an event registration module that takes entries,
issues payment instructions, and turns paid entries into the teams, draw and
results the site publishes.

| | |
| --- | --- |
| Framework | Laravel 13.24 |
| PHP | 8.3 |
| Database | MariaDB 10.6 (MySQL-compatible), tables prefixed `terre217_` |
| Web server | Apache 2.4 with `mod_php` |
| Namespace | `terre\` (not `App\` — a legacy of the original template) |

Originally Laravel 5.4 on PHP 5.6; migrated one minor version at a time. See
[Upgrade history](#upgrade-history).

### Two halves, different rules

The **front-end is single-purpose**: it serves the tournament and nothing else.
Earlier front-ends — a money changer and a foundation site — have been removed,
and their routes, controllers and views with them.

The **admin is a general CMS**, carried between projects. It ships modules this
tournament does not use — products, projects, press, stores, testimonials,
galleries, services. They are the template's inventory, not dead code; a module
having no public page here is not a reason to remove it. Clean up the front-end;
leave the admin alone.

### What an admin can change

Everything the public site shows, except brand copy. All of it is in the admin
behind the obfuscated prefix.

| Menu | Controls |
| --- | --- |
| Events → Manage Events | Title, venue, format, fee, dates, **phase** — the switch that publishes the draw and the champions |
| Events → Registrations | Verify a payment; `paid` puts the club on the site |
| Events → Teams, Team Players | Clubs, squads, photos, seeding |
| Events → Schedule, Draw | Ties, courts, kick-off times, results |
| Events → Categories, Partners | The draws on offer; the sponsor logos |
| Pages | Privacy, terms, contact, rules, FAQ |
| Global Configurations → Social Link | The footer's social accounts |
| Global Configurations → Upload Logo | The admin's own logo |

---

## Table of contents

- [The tournament site](#the-tournament-site)
- [Local development](#local-development)
- [Production](#production)
- [Configuration reference](#configuration-reference)
- [The database](#the-database)
- [Testing](#testing)
- [Project layout](#project-layout)
- [Troubleshooting](#troubleshooting)
- [Upgrade history](#upgrade-history)

---

## The tournament site

Sliced from `JTC_Desktop_Master_New.psd` (five 1440px artboards) and served from
the document root. Every page is `app/Http/Controllers/Jtc.php` against
`resources/views/jtc/`, in a theme that carries its own stylesheet, script and
assets and uses no CSS framework.

| Route | Name | Reads |
| --- | --- | --- |
| `/` | `jtc_home` | Event dates, venue, categories, entry status, partners, last edition's totals |
| `/past-winners` | `jtc_past_winners` | Champions, from the finals in `event_matches` |
| `/schedule` | `jtc_schedule` | Order of play, from ties that have a `starts_at` |
| `/draw` | `jtc_draw` | Bracket per category, from `event_matches` |
| `/register` | `jtc_register` | Fee, format, categories, and the entry form |
| `/{slug}` | `jtc_page` | An editorial page from the CMS — privacy, terms, contact, rules, FAQ |

`/{slug}` is registered **last** and matches a single segment, so every named
route above claims its own path first and an unpublished slug is a 404.

### Everything on these pages comes from the CMS

Nothing on the public site is hardcoded except brand copy — the hero campaign
line and the "More Than A Tournament" block, which have no data behind them.

| On the page | Comes from |
| --- | --- |
| Tournament dates | The days the ties are played (`event_matches.starts_at`) |
| Venue, format, entry fee | `events.venue`, `.venue_detail`, `.format`, `.price` |
| Categories | `event_categories` |
| Entry status | The event's phase and its date window |
| Schedule, draw, champions | `event_matches`, three readings of the same rows |
| "In numbers" | Counted from the last edition whose results are public |
| Partners | `event_partners`, per edition |
| Footer social icons | The CMS's `social_link` module |
| Footer legal links | Static pages flagged for the footer |

### Phases

An event moves through four phases, set by an admin on the event record. The
phase decides what the public site will show; **no page ever disappears from the
navigation**, it explains itself instead.

| Phase | Entries | Draw | Champions |
| --- | --- | --- | --- |
| `registration` | open | hidden | hidden |
| `draw` | closed | published | hidden |
| `running` | closed | published | as ties are decided |
| `finished` | closed | published | complete |

Entries also respect the event's own date window, so `registration` alone does
not keep a closed event open — and an event past that phase is closed whatever
its dates say.

Past winners is gated on the same rule as the draw. Without it the page crowned
a champion from a bracket the draw page was still refusing to show, both reading
the same rows.

### Empty states, not empty pages

A page whose data is not published yet says so. The draw explains the phase, the
schedule says no ties are scheduled, past winners says no champion has been
crowned. Tabs are built from data that exists, so no tab leads to an empty table.

The one deliberate exception is the home page's "in numbers" band, which is
absent rather than zeroed until an edition has been played: it is a boast in the
middle of a page, not a destination somebody navigated to.

### Registration flow

```
entrant submits the form
   └─ POST /event/{slug}/register        pending
      └─ payment instructions emailed, quoting a registration code
         └─ GET  /event/payment/{code}   entrant uploads proof
            └─ POST same route           awaiting_verification
               └─ admin verifies in the CMS
                  └─ paid  ──▶ club appears on the public site
```

Reaching `paid` creates the club and its squad automatically. Losing that status
unpublishes the team rather than deleting it, so an admin's later work — seed,
group, photos — is never destroyed by a status change. Codes are random, not
sequential, because the confirmation page is reachable by code alone.

The 2026 design closes the public entry form, so nothing links to that first
POST; the route behind it is still live, and the confirmation page is the one
public page that writes to the database.

### Derived, not stored

Match winners, the champion, a club's record and the hero counters are
**computed from `event_matches` and the event record** on each request. There is
no "champion" column to forget to update, and no way for a stored summary to
disagree with the ties it summarises.

### The retired theme

`old/` holds the front-end this one replaced — controller, views and assets. It
is the only place the public pages were ever wired to the CMS in the older
shape, so it is kept for reference; nothing routes to it and `.htaccess` denies
the whole directory.

---

## Local development

### Requirements

Docker Desktop (or Docker Engine + Compose v2). Nothing else — no local PHP,
Composer or MySQL. `vendor/` is installed inside the image.

### Start

```bash
docker compose up -d --build
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

First run takes a few minutes: it builds the PHP image, imports the SQL dump and
converts the schema. Subsequent starts take seconds.

**Neither of those two steps is optional on a fresh volume.** The SQL dump
predates the tournament, so it has no `event*` tables and no tournament in them;
the entrypoint runs neither command, and every tournament page queries those
tables. Skip the migrate and the site answers 500; skip the seed and it comes up
correct but empty, every page in its no-data state.

`db:seed` runs `TournamentSeeder` — one event, eight clubs with their squads,
six categories, a complete eight-team draw with results, and five schedule days.
It keys on the event slug and rebuilds only that event's rows, so it is safe to
re-run and will not duplicate. The club and player names are placeholders meant
to be corrected in the admin.

| Service | URL | Credentials |
| --- | --- | --- |
| Site | http://localhost:8088 | — |
| Admin | http://localhost:8088/_d50d0608e7c3270b3f0e3753f996387b/login | from the SQL dump |
| phpMyAdmin | http://localhost:8089 | `cms` / `secret` |
| MariaDB | `127.0.0.1:33061` | `cms` / `secret` |

The admin prefix is an obfuscation measure in `routes/web.php`, not a secret —
treat it as a URL, not a security control.

### Seed a test admin

The accounts in the dump have unknown passwords. For a known login:

```bash
./scripts/seed-test-admin.sh
```

Creates `smoke@test.local` / `smoketest123`. **Local database only** — the
credentials are deliberately well-known.

### Everyday commands

```bash
docker compose logs -f app
```

```bash
docker compose exec app bash
```

```bash
docker compose exec app php artisan cache:clear
```

Source is bind-mounted and opcache is off, so edits apply on the next request —
no rebuild needed. Rebuild only when `Dockerfile`, `composer.json` or anything
under `docker/` changes:

```bash
docker compose up -d --build
```

### Changing ports

Compose variables are `DOCKER_`-prefixed because Compose also auto-reads the
Laravel `.env` in this directory for `${VAR}` interpolation, and that file
defines `DB_PORT` — an unprefixed `DB_PORT` here would silently inherit it.

```bash
DOCKER_APP_PORT=9090 DOCKER_PMA_PORT=9091 docker compose up -d
```

### How local config is loaded

Your production `.env` is **never read**. Laravel loads `.env.<APP_ENV>` when
`APP_ENV` is set in the real environment, so `docker-compose.yml` sets
`APP_ENV=docker` and the app reads **`.env.docker`**. Edit that file for local
settings; it is committed on purpose and holds only throwaway credentials.

---

## Production

> The live site currently runs on **cPanel shared hosting, not Docker**. What
> follows is a self-contained Docker deployment; adopting it is a migration, not
> a redeploy. Read [Before the first deploy](#before-the-first-deploy) first.

### What differs from local

| | Local | Production |
| --- | --- | --- |
| Build target | `development` | `production` |
| Source | bind-mounted | baked into the image |
| Composer | dev dependencies | `--no-dev --optimize-autoloader` |
| Opcache | off | on, `validate_timestamps=0` |
| `APP_DEBUG` | `true` | `false` |
| Errors | logged, not shown | logged, never shown |
| Config | read each request | cached at container start |
| Compose file | `docker-compose.yml` | `docker-compose.prod.yml` |
| Database | container, seeded from the dump | external, yours to provision |
| phpMyAdmin | included | not included |

### Deploy

```bash
cp .env.prod.example .env.prod
```

Fill it in — every value in it is required and the stack refuses to start
without them. Then:

```bash
docker compose --env-file .env.prod -f docker-compose.prod.yml up -d --build
```

The stack sets its own Compose project name (`cms-template-engine-prod`), so it
will not collide with a development stack on the same machine.

To ship a new version, rebuild and replace — the image is immutable and holds
the code:

```bash
docker compose --env-file .env.prod -f docker-compose.prod.yml up -d --build
```

### Before the first deploy

**Generate a fresh `APP_KEY`.** Never reuse the one in `.env.docker`; it is
committed and therefore public. Changing the key later invalidates all sessions
and any encrypted data.

```bash
docker run --rm cms-template-engine:latest php artisan key:generate --show
```

**Put TLS in front of it.** The container publishes to `127.0.0.1` only, by
design. Terminate TLS in a reverse proxy (nginx, Caddy, Traefik, a load
balancer) and forward to that port. Without this the admin login travels in
plaintext.

**Provision the database yourself.** `docker-compose.prod.yml` has no `db`
service — a database whose lifecycle is tied to an application deploy is a bad
idea. Point `DB_HOST` at a managed instance or a separately managed container.
To create the schema, apply the three files in the order given under
[The database](#the-database). Keep `DB_PREFIX=terre217_`.

**Fill in `.env`, and rotate what used to be in it.** `.env` is untracked and
its credentials are placeholders — `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`,
`MAIL_HOST` and `MAIL_PASSWORD` all read `CHANGE_ME_*`, so a deploy fails loudly
rather than connecting somewhere unintended. The credentials that used to sit
there and in `.env.prod.example` are in the git history and should be treated as
compromised.

Bear in mind the document root serves the project root, so on any host without
the deny rules in `docker/apache/vhost.conf`, `.env` is reachable over HTTP.

**Check the from-address.** `MAIL_FROM_ADDRESS` must be a mailbox the SMTP
account is allowed to send as, or the provider will rewrite or reject it — and
that address is what every registration payment instruction goes out under.

**Persist uploads.** Two named volumes, `uploads` and `storage`, hold everything
the container writes. Without them every image uploaded through the CMS is lost
on the next deploy. Back them up.

### What is deliberately not done

`artisan route:cache` is **not** run, and will fail if you try: `routes/web.php`
and `routes/api.php` both define closure routes, which cannot be serialised.
Converting those two closures to controller actions would unlock it.

`artisan config:cache` **is** run — but at container start, in
`docker/entrypoint.sh`, not at build time, so it captures the real runtime
environment rather than build-time values.

Three admin controllers used to call `env('APP_URL')` directly. Under a cached
config `env()` returns `null` outside config files, which would have silently
broken every generated page permalink; they now call `config('app.url')`. Bear
this in mind before adding any new `env()` call outside `config/`.

---

## Configuration reference

| Variable | Local default | Notes |
| --- | --- | --- |
| `APP_ENV` | `docker` | Selects which `.env.<APP_ENV>` file is read |
| `APP_KEY` | committed dev key | **Must** be unique per deployment |
| `APP_DEBUG` | `true` | `false` in production, always |
| `APP_URL` | `http://localhost:8088` | Admin page permalinks, and the filemanager's base URL. No trailing slash |
| `DB_PREFIX` | `terre217_` | The existing schema is prefixed; do not drop this |
| `LOG_CHANNEL` | `stack` | `stderr` in production, for `docker logs` |
| `LOG_LEVEL` | `debug` | `error` in production. `APP_LOG_LEVEL` is a Laravel 5.x key and is no longer read |
| `MAIL_DRIVER` | `log` | Locally, mail is written to `storage/logs`. **`config/mail.php` reads this, not `MAIL_MAILER`** — keep both in step |
| `MAIL_FROM_ADDRESS` | `no-reply@localhost` | The address registration emails are sent from |
| `MAIL_FROM_NAME` | `CMS Template Engine` | Display name on the same |

Production reads its values from the environment via `--env-file`, so nothing
secret is committed. Local values live in `.env.docker`.

---

## The database

The dev `db` volume is seeded on first boot from three files, in order:

| File | Purpose |
| --- | --- |
| `cms-template-engine.sql` | phpMyAdmin dump from the original host, 58 tables |
| `docker/mysql/init/02-modernize-schema.sql` | MyISAM → InnoDB, utf8mb3 → utf8mb4 |
| `docker/mysql/init/03-zero-dates.sql` | Zero dates → `NULL` |

The `event*` tables are **not** in that dump — they postdate it, and are created
by the migrations this project owns:

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

| Migration | What it does |
| --- | --- |
| `create_event_*` | The eight event tables: events, registrations, teams, members, categories, schedule, matches, partners |
| `add_starts_at_to_event_matches` | When a tie is played. `round` is a position in the draw, not a time |
| `add_venue_to_events`, `add_format_to_events` | Where and how this edition is played |
| `fix_missing_auto_increment`, `fix_static_page_auto_increment` | Repairs, see below |

Beyond those, `database/migrations/` holds only the three stock Laravel tables
(`users`, `password_resets`, `personal_access_tokens`). The other 58 tables are
the dump's, and no migration reproduces them — do not expect a migration to
build this schema from nothing.

### Three tables lost their AUTO_INCREMENT

`social_link`, `brand` and `static_page` came out of the dump with a primary key
that does not auto-increment. It looks fine and behaves badly: through the app
every insert fails with *Field 'id' doesn't have a default value*, so **Add
Social Link, Add Brand and Add Page simply did not work**; through a connection
without strict mode the insert succeeds and writes `id = 0`, and the next one
collides with it. Two migrations restore it, starting each counter past the
highest id present. Worth checking on any other database built from this dump.

### Seeders

```bash
docker compose exec app php artisan db:seed                     # all of them
docker compose exec app php artisan db:seed --class="Database\Seeders\PagesSeeder"
```

| Seeder | Writes |
| --- | --- |
| `TournamentSeeder` | One edition: 8 clubs and squads, 6 categories, a full bracket with results, 5 schedule days, 7 partner logos |
| `SocialLinksSeeder` | Instagram, YouTube and LinkedIn, ready for a handle |
| `PagesSeeder` | Privacy, terms, contact, rules and FAQ |

All three are idempotent and none destroys editorial work: `PagesSeeder` skips
any page whose text has been changed, `SocialLinksSeeder` keeps a handle someone
entered, and `TournamentSeeder` rebuilds only its own event's rows.

They also retire what the template shipped that does not belong on a tennis
site — the money changer's currency page and the template author's own social
accounts. **Unpublished, never deleted**, so one click in the admin brings any
of them back.

Both migration scripts are idempotent, so they can be applied by hand — this is
also how you would prepare a production database:

```bash
docker compose exec -T db mysql -ucms -psecret cms_template_engine < docker/mysql/init/02-modernize-schema.sql
```

Rebuild from scratch. **`down -v` destroys the volume, and with it every event,
club, squad, tie and schedule row** — none of that is in the dump, so the only
way back is the seeder, with whatever the admin had edited since lost. Export
first if the content matters:

```bash
docker compose exec db mysqldump -uroot -proot cms_template_engine \
  --tables $(docker compose exec -T db mysql -uroot -proot -sN -e \
  "SELECT GROUP_CONCAT(table_name SEPARATOR ' ') FROM information_schema.tables \
   WHERE table_schema='cms_template_engine' AND table_name LIKE 'terre217\_event%';") \
  > event-content.sql
```

Then:

```bash
docker compose down -v && docker compose up -d
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

### Strict mode

The application connection runs Laravel's **full** strict `sql_mode`,
`ONLY_FULL_GROUP_BY` included. `config/database.php` used to pin the modes by
hand to drop that one rule, because the old front-end's product-category listing
selected columns it did not group by. That query went with the front-end, so the
override went too.

The *server* `sql_mode` in `docker/mysql/my.cnf` stays permissive, because the
dump itself cannot be imported under `NO_ZERO_DATE`. The app's own connection is
strict regardless.

---

## Testing

```bash
./scripts/smoke-test.sh
```

73 checks against a running stack: every public route, a structural marker on
each page so a template that renders empty is caught rather than passing on its
status code, the five editorial pages and a 404 for a slug nobody published, the
full registration round trip (which cleans up the registration it creates),
theme assets, error handling, admin login and CSRF, twelve authenticated admin
screens including every event module, the Imagine thumbnail and effects
pipeline, the deny rules — including the archived theme under `old/` — and a
scan for PHP errors leaking into responses. Run it after any dependency or
configuration change.

Checks that depend on event data accept either the data or the notice standing
in for it, because both are correct: what they reject is a blank page, a tab
leading to nothing, or a link still pointing at `#`.

Point it at another environment by passing a base URL:

```bash
./scripts/smoke-test.sh http://localhost:8092
```

Two checks exist because of bugs that passed everything else:

- It requests an unknown route and asserts no PHP fatal. Laravel 7's retyping of
  the exception handler stopped the `Handler` class loading entirely, and no
  successful request noticed.
- It logs in **twice**. Laravel 11+ rehashes a password on successful login, so
  a bug in the password mutator corrupted the stored hash on the *first* login
  and only surfaced on the second.

---

## Project layout

```
app/
  Admin/          Admin panel controllers, models, middleware
  Http/
    Controllers/  Jtc.php, EventRegistration.php, Auth/
    Models/       Event*Model, StaticPageModel, SocialLinkModel — shared
                  with the admin's modules
  Libraries/      Local replacements for removed framework pieces
config/
database/
  migrations/     The event tables and two repairs; the rest is the SQL dump
docker/
  apache/         vhost, including the deny rules
  mysql/          my.cnf and the two schema migrations
  php/            php.ini (dev) and php.prod.ini
database/
  seeders/        Tournament, social links and pages
old/              The retired front-end, denied over HTTP
resources/
  admin/views/    Admin panel Blade templates
  assets/         CSS, JS, images and uploads — served publicly
    jtc/          Theme CSS, JS and imagery
    uploads/      What the admin writes: partner logos, team photos, proofs
  views/
    jtc/          Theme templates, partials and the editorial page
    emails/       Payment instructions
    events/       Payment confirmation and proof upload
routes/web.php    Admin behind the obfuscated prefix; the theme at the root,
                  with the editorial-page catch-all registered last
scripts/          smoke-test.sh, seed-test-admin.sh
```

The admin's event modules and the public site share one set of models under
`app/Http/Models/`, so a rule such as "losing paid status unpublishes the team"
holds no matter which side of the CMS makes the change.

### Document root

The document root is the **project root**, not `public/` — mirroring the cPanel
host, where `index.php` sits at the root and views reference assets as
`asset('resources/assets/...')`, which only resolves from there. `public/`
contains only a stock `index.php` and is unused.

Because the project root is served, everything that exists on disk is a
candidate for being served as a plain file. The rewrite only forwards a request
to Laravel when the path does **not** exist, so a real file bypasses the
framework entirely. `.htaccess` therefore denies `app/`, `bootstrap/`, `config/`,
`database/`, `docker/`, `old/`, `scripts/`, `storage/`, `tests/`, `vendor/`,
`resources/views/`, `resources/lang/`, dotfiles, and `*.sql *.log *.md *.json`
and friends. `resources/assets/` stays public, as the app requires.

**`.htaccess` is the only protection a cPanel host has.**
`docker/apache/vhost.conf` carries the equivalent rules for the container and
never ships anywhere. Before those rules existed, the live site served
`cms-template-engine.sql` — the whole database, admin password hashes included —
and `storage/logs/laravel.log`, whose stack traces carry credentials, to anyone
who asked. The smoke suite asserts they are denied.

Moving to a `public/` document root is the conventional fix, but it means
relocating `resources/assets`, updating the 21 views that reference it — the
tournament templates go through `terre\Libraries\Asset::v()`, which also appends
an mtime cache-buster — along with the admin upload paths, and matching changes
on the host. It has not been done.

---

## Troubleshooting

**`port is already allocated`** — something else holds 8088/8089. Override with
`DOCKER_APP_PORT` / `DOCKER_PMA_PORT`.

**Container sits at `waiting for database`** — the entrypoint probes the
database through PDO for up to 120s, then starts Apache anyway. Check
`docker compose logs db`. The probe honours `DB_PORT`; a wrong port is the usual
cause.

**Changes to `config/` not taking effect** — in production the config is cached
at container start, so restart the container. Locally, run
`docker compose exec app php artisan config:clear` if a cache was ever built.

**Blank page or 500 with nothing in the browser** — by design; errors go to the
container log, never the response. `docker compose logs app`.

**Slow on Apple Silicon** — there should be no `platform:` pin;
`php:8.3-apache` has a native arm64 build. If you set `DOCKER_PHP_VERSION` back
to a 7.x release for bisecting, re-add `platform: linux/amd64`, since those
images are amd64-only and run emulated at roughly 2.5s per request.

---

## Upgrade history

Migrated from Laravel 5.4 / PHP 5.6 to Laravel 13 / PHP 8.3 one minor version at
a time. Each step is a separate commit, tagged `laravel-5.4-baseline` through
`laravel-13.0`, and passed the smoke suite before the next began.

Three abandoned dependencies were replaced with local equivalents in
`app/Libraries/`, chosen over third-party replacements so the ~470 existing call
sites did not have to change:

| Removed | Replaced by | Why |
| --- | --- | --- |
| `illuminate/html` | `terre\Libraries\Html` | Abandoned after Laravel 5.0 |
| `Input` facade | `terre\Libraries\Input` | Removed in Laravel 6 (256 call sites) |
| `folklore/image` | `terre\Libraries\Image` | Pinned `illuminate/support` to `~5.0` |

`imagine/imagine` itself was kept — `folklore/image` was only a Laravel facade
over it, so the thumbnail and effects calls in `ScaffoldController` and the eight
image controllers did not need rewriting.

`git log` carries the detail; each commit message explains what broke in that
version and why the fix took the shape it did.
