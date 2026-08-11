# Running this project with Docker

Laravel 5.4 CMS, containerised for local development.

## Quick start

```bash
docker compose up -d --build
```

| Service    | URL                                              |
| ---------- | ------------------------------------------------ |
| Site       | http://localhost:8088                            |
| Admin      | http://localhost:8088/_d50d0608e7c3270b3f0e3753f996387b/login |
| phpMyAdmin | http://localhost:8089 (`cms` / `secret`)         |
| MariaDB    | `127.0.0.1:33061` (`cms` / `secret`)             |

The database is imported automatically from `cms-template-engine.sql` the first
time the `db` volume is created. Existing admin accounts come from that dump
(`admin@admin.com`, `ilyas.raswandi@gmail.com`, `asadahlan@duasisimoneychanger.co.id`) —
their passwords are the hashes already in the dump, so use whichever you know.

Ports are overridable without editing the compose file:

```bash
DOCKER_APP_PORT=9090 DOCKER_PMA_PORT=9091 docker compose up -d
```

## How configuration works

Your production `.env` is **not** touched. Laravel 5.4 loads `.env.<APP_ENV>`
when `APP_ENV` is set in the real environment, so `docker-compose.yml` sets
`APP_ENV=docker` and the app reads **`.env.docker`** instead. Edit that file for
container settings.

Note that Compose also auto-reads the Laravel `.env` in this directory for
`${VAR}` interpolation — that is why the compose variables are all
`DOCKER_`-prefixed, to avoid colliding with keys like `DB_PORT` defined there.

## Why these versions

- **PHP 7.1** — `laravel/framework 5.4`, `illuminate/html 5.0` and
  `folklore/image 0.2` predate PHP 7.2. On 7.2+ Laravel 5.4's `count()` and
  `each()` usage emits warnings that render into the page.
  `php:7.1-apache` is published for `linux/amd64` only, so on Apple Silicon the
  `app` container runs under emulation (`platform: linux/amd64`). It is slower
  to build but runs fine.
- **MariaDB 10.6** — matches the server the dump was taken from. `sql_mode` is
  relaxed to `NO_ENGINE_SUBSTITUTION` in `docker/mysql/my.cnf` because the dump
  is MyISAM/utf8mb3 and declares `timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'`,
  which a strict mode rejects.

## Document root

The document root is the **project root**, not `public/`. That mirrors the
cPanel host this app is deployed on: `index.php` sits at the root, and views
reference assets as `asset('resources/assets/...')`, which only resolves from
there. `public/` contains only a stock `index.php` and is unused.

Because the project root is served, `docker/apache/vhost.conf` explicitly denies
HTTP access to `app/`, `bootstrap/`, `config/`, `database/`, `storage/`,
`tests/`, `vendor/`, `resources/views/`, `resources/lang/`, dotfiles (`.env`),
`*.sql` and `*.log`. `resources/assets/` stays public, as the app requires.

## Common commands

```bash
docker compose exec app bash
```

```bash
docker compose exec app php artisan cache:clear
```

```bash
docker compose logs -f app
```

Re-import the database from scratch (destroys all local DB data):

```bash
docker compose down -v && docker compose up -d
```

## Notes

- `vendor/` is committed and mounted from the host, so no `composer install` is
  needed. If you do run Composer, do it inside the container so it resolves
  against PHP 7.1.
- Mail is set to the `log` driver — outgoing mail lands in `storage/logs`
  instead of being sent.
- Opcache is disabled so edits on the bind mount take effect immediately.
- `storage/` and `bootstrap/cache` permissions are fixed on container start by
  `docker/entrypoint.sh`.
