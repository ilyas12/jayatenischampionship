# CMS Template Engine

The Laravel CMS behind **Dua Sisi Money Changer** (`duasisimoneychanger.co.id`) —
exchange rates, branches, news and events, and static pages, with a custom admin
panel behind an obfuscated URL prefix.

| | |
| --- | --- |
| Framework | Laravel 13.24 |
| PHP | 8.3 |
| Database | MariaDB 10.6 (MySQL-compatible), tables prefixed `terre217_` |
| Web server | Apache 2.4 with `mod_php` |
| Namespace | `terre\` (not `App\` — a legacy of the original template) |

Originally Laravel 5.4 on PHP 5.6; migrated one minor version at a time. See
[Upgrade history](#upgrade-history).

---

## Table of contents

- [Local development](#local-development)
- [Production](#production)
- [Configuration reference](#configuration-reference)
- [The database](#the-database)
- [Testing](#testing)
- [Project layout](#project-layout)
- [Troubleshooting](#troubleshooting)
- [Upgrade history](#upgrade-history)

---

## Local development

### Requirements

Docker Desktop (or Docker Engine + Compose v2). Nothing else — no local PHP,
Composer or MySQL. `vendor/` is installed inside the image.

### Start

```bash
docker compose up -d --build
```

First run takes a few minutes: it builds the PHP image, imports the SQL dump and
converts the schema. Subsequent starts take seconds.

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

**Rotate the credentials in `.env`.** The committed `.env` contains live
database and Gmail credentials, and the document root serves the project root,
so on a host without the deny rules in `docker/apache/vhost.conf` they are
reachable over HTTP. Treat them as compromised.

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
| `APP_URL` | `http://localhost:8088` | Builds admin page permalinks |
| `DB_PREFIX` | `terre217_` | The existing schema is prefixed; do not drop this |
| `LOG_CHANNEL` | `stack` | `stderr` in production, for `docker logs` |
| `MAIL_DRIVER` | `log` | Locally, mail is written to `storage/logs` |

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

Both migration scripts are idempotent, so they can be applied by hand — this is
also how you would prepare a production database:

```bash
docker compose exec -T db mysql -ucms -psecret cms_template_engine < docker/mysql/init/02-modernize-schema.sql
```

Rebuild from scratch, destroying all local data:

```bash
docker compose down -v && docker compose up -d
```

### Strict mode

The application connection runs a strict `sql_mode`, pinned explicitly in
`config/database.php`. It keeps `STRICT_TRANS_TABLES` and `NO_ZERO_DATE` but
omits `ONLY_FULL_GROUP_BY`, which is a query-style rule rather than a
data-integrity one: several legacy `GROUP BY` queries select columns they do not
group by, and the homepage's product-category listing returns a 500 under it.
Fixing those queries and dropping the `modes` key is outstanding work.

The *server* `sql_mode` in `docker/mysql/my.cnf` stays permissive, because the
dump itself cannot be imported under `NO_ZERO_DATE`. The app's own connection is
strict regardless.

---

## Testing

```bash
./scripts/smoke-test.sh
```

33 checks against a running stack: public routes, a database-backed news detail
page, static assets, error handling, admin login and CSRF, six authenticated
admin screens, the Imagine thumbnail and effects pipeline, the vhost deny rules,
and a scan for PHP errors leaking into responses. Run it after any dependency or
configuration change.

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
  Http/           Public site controllers and models
  Libraries/      Local replacements for removed framework pieces
config/
docker/
  apache/         vhost, including the deny rules
  mysql/          my.cnf and the two schema migrations
  php/            php.ini (dev) and php.prod.ini
resources/
  admin/views/    Admin panel Blade templates
  assets/         CSS, JS, images and uploads — served publicly
  views/          Public site Blade templates
routes/web.php    Admin routes are prefixed; public routes are `_dsv2` methods
scripts/          smoke-test.sh, seed-test-admin.sh
```

### Document root

The document root is the **project root**, not `public/` — mirroring the cPanel
host, where `index.php` sits at the root and views reference assets as
`asset('resources/assets/...')`, which only resolves from there. `public/`
contains only a stock `index.php` and is unused.

Because the project root is served, `docker/apache/vhost.conf` explicitly denies
HTTP access to `app/`, `bootstrap/`, `config/`, `database/`, `storage/`,
`tests/`, `vendor/`, `resources/views/`, `resources/lang/`, dotfiles, `*.sql`
and `*.log`. `resources/assets/` stays public, as the app requires. **Any host
serving this project without equivalent rules exposes `.env`.**

Moving to a `public/` document root is the conventional fix, but it means
relocating `resources/assets`, updating `asset()` calls across 44 views and the
admin upload paths, and matching changes on the host. It has not been done.

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
