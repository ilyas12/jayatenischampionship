# Running this project with Docker

Laravel 13 CMS on PHP 8.3, containerised for local development.

## Quick start

```bash
docker compose up -d --build
```

| Service    | URL                                                           |
| ---------- | ------------------------------------------------------------- |
| Site       | http://localhost:8088                                         |
| Admin      | http://localhost:8088/_d50d0608e7c3270b3f0e3753f996387b/login |
| phpMyAdmin | http://localhost:8089 (`cms` / `secret`)                      |
| MariaDB    | `127.0.0.1:33061` (`cms` / `secret`)                          |

Ports are overridable. They are `DOCKER_`-prefixed because Compose also
auto-reads the Laravel `.env` in this directory for `${VAR}` interpolation, and
that file defines `DB_PORT`:

```bash
DOCKER_APP_PORT=9090 DOCKER_PMA_PORT=9091 docker compose up -d
```

## Configuration

Your production `.env` is **not** touched. Laravel loads `.env.<APP_ENV>` when
`APP_ENV` is set in the real environment, so `docker-compose.yml` sets
`APP_ENV=docker` and the app reads **`.env.docker`** instead. Edit that file for
container settings.

## The database

The `db` volume is seeded on first boot from three files, in order:

| File                                       | Purpose                                                    |
| ------------------------------------------ | ---------------------------------------------------------- |
| `cms-template-engine.sql`                  | The phpMyAdmin dump from the original host (58 tables)      |
| `docker/mysql/init/02-modernize-schema.sql`| MyISAM → InnoDB, utf8mb3 → utf8mb4, incl. the DB default    |
| `docker/mysql/init/03-zero-dates.sql`      | Zero dates → NULL so strict mode is possible               |

Both migration scripts are idempotent, so they can also be applied by hand:

```bash
docker compose exec -T db mysql -ucms -psecret cms_template_engine < docker/mysql/init/02-modernize-schema.sql
```

Rebuild the database from scratch (destroys all local DB data):

```bash
docker compose down -v && docker compose up -d
```

The server-level `sql_mode` in `docker/mysql/my.cnf` stays permissive because
the dump itself cannot be imported under `NO_ZERO_DATE`. The application's own
connection is strict regardless — see `config/database.php`, which pins `modes`
explicitly to keep `STRICT_TRANS_TABLES` and `NO_ZERO_DATE` while omitting
`ONLY_FULL_GROUP_BY`. That last one is a query-style rule, and several legacy
`GROUP BY` queries select columns they do not group by; the homepage's
product-category listing 500s under it. Fixing those queries and removing the
`modes` key is outstanding work.

## Testing

```bash
./scripts/smoke-test.sh
```

33 checks: public routes, a DB-backed news detail page, static assets, error
handling, the admin login and CSRF path, six authenticated admin screens, the
Imagine thumbnail and effects pipeline, the vhost deny rules, and a scan for PHP
errors leaking into responses. Run it after any dependency or config change.

The authenticated half needs a local-only test account:

```bash
./scripts/seed-test-admin.sh
```

Two of those checks exist because of bugs that passed everything else:

- It requests an unknown route and asserts no PHP fatal, because Laravel 7's
  retyping of the exception handler stopped the `Handler` class loading without
  any successful request noticing.
- It logs in **twice**. Laravel 11+ rehashes a password on successful login, so
  a bug in the password mutator corrupts the stored hash on the *first* login
  and only shows up on the second.

## Document root

The document root is the **project root**, not `public/`. That mirrors the cPanel
host this app is deployed on: `index.php` sits at the root, and views reference
assets as `asset('resources/assets/...')`, which only resolves from there.
`public/` contains only a stock `index.php` and is unused.

Because the project root is served, `docker/apache/vhost.conf` explicitly denies
HTTP access to `app/`, `bootstrap/`, `config/`, `database/`, `storage/`,
`tests/`, `vendor/`, `resources/views/`, `resources/lang/`, dotfiles (`.env`),
`*.sql` and `*.log`. `resources/assets/` stays public, as the app requires.

Moving to a `public/` document root would be the more conventional layout, but it
means relocating `resources/assets`, updating `asset()` calls across 44 views and
the admin upload paths, and matching changes on the cPanel host. It has not been
done.

## PHP and image notes

- `PHP_VERSION` and `COMPOSER_VERSION` are build args, a leftover convenience
  from stepping this app from PHP 7.1 to 8.3 one version at a time. The
  Dockerfile still handles archived-Debian apt mirrors and the pre-7.4 `gd`
  configure flags, so older versions remain buildable for bisecting.
- There is no `platform` pin. `php:8.3-apache` has a native arm64 build; the
  PHP 7.x images were amd64-only and had to be emulated on Apple Silicon, which
  cost about 2.5s per request (the smoke suite took minutes rather than the ~9s
  it takes now). Re-add `platform: linux/amd64` if you set `DOCKER_PHP_VERSION`
  back to a 7.x release to bisect something.
- `libonig-dev` is installed because `mbstring` stopped bundling oniguruma in
  PHP 7.4.
- Opcache is disabled so edits on the bind mount take effect immediately.
- `storage/` and `bootstrap/cache` permissions are fixed on container start by
  `docker/entrypoint.sh`, which also waits for the database via PDO — the same
  driver the app uses, rather than the `mysql` client, whose newer builds require
  TLS and disagree with the server about reachability.

## Upgrade history

This project was migrated from Laravel 5.4 / PHP 5.6 to Laravel 13 / PHP 8.3 one
minor version at a time. Each step is a separate commit with a tag
(`laravel-5.4-baseline` through `laravel-13.0`) and passed the smoke suite before
the next began. Notable replacements, all in `app/Libraries/`:

| Removed                  | Replaced by                     | Why                                    |
| ------------------------ | ------------------------------- | -------------------------------------- |
| `illuminate/html`        | `terre\Libraries\Html`          | Abandoned after Laravel 5.0            |
| `Input` facade           | `terre\Libraries\Input`         | Removed in Laravel 6 (256 call sites)  |
| `folklore/image`         | `terre\Libraries\Image`         | Pinned `illuminate/support` to `~5.0`  |

`imagine/imagine` itself was kept — `folklore/image` was only a Laravel facade
over it, and keeping Imagine meant the thumbnail and effects calls in
`ScaffoldController` and the eight image controllers did not have to change.
