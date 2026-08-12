#!/bin/bash
set -e

# Laravel expects these to exist; they are gitignored, so a fresh checkout or a
# freshly mounted volume may be missing them.
mkdir -p \
    /var/www/html/storage/framework/{cache,sessions,views} \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache 2>/dev/null || true

for dir in storage bootstrap/cache; do
    [ -d "/var/www/html/$dir" ] || continue
    chown -R www-data:www-data "/var/www/html/$dir" 2>/dev/null || true

    # In development these arrive over a bind mount owned by the host user, and
    # the container's www-data uid will not match, so they are opened up. That
    # would be world-writable in production, where a chown is enough.
    if [ "${APP_ENV:-}" != "production" ]; then
        chmod -R a+rwX "/var/www/html/$dir" 2>/dev/null || true
    fi
done

# Wait for MariaDB before handing over to Apache, so the first request does not
# land on a still-importing database.
#
# The probe goes through PDO rather than the mysqladmin client on purpose: it is
# the exact driver the application connects with, so it cannot disagree with the
# app about whether the database is reachable. The bundled client did diverge —
# from Debian trixie it defaults to requiring TLS and refuses a plaintext
# MariaDB 10.6 server that PDO connects to happily, which hung this script for
# the full timeout on every start.
if [ -n "${DB_HOST:-}" ]; then
    echo "entrypoint: waiting for database at ${DB_HOST}..."
    for i in $(seq 1 60); do
        if php -r '
            try {
                // DB_PORT must be part of the DSN. Omitting it silently probes
                // 3306 regardless of configuration, which happens to be right
                // inside the compose network and wrong everywhere else.
                $port = getenv("DB_PORT") ?: "3306";
                new PDO(
                    "mysql:host=".getenv("DB_HOST").";port=".$port.";dbname=".getenv("DB_DATABASE"),
                    getenv("DB_USERNAME"),
                    getenv("DB_PASSWORD")
                );
                exit(0);
            } catch (Throwable $e) {
                exit(1);
            }
        ' >/dev/null 2>&1; then
            echo "entrypoint: database is up"
            break
        fi
        if [ "$i" -eq 60 ]; then
            echo "entrypoint: database still unreachable after 120s — starting Apache anyway" >&2
        fi
        sleep 2
    done
fi

# Cache the config here rather than at build time, so it captures the real
# runtime environment instead of whatever was set when the image was built.
#
# Route caching is deliberately not attempted: routes/web.php and routes/api.php
# both define closure routes, which cannot be serialised. Converting those two
# closures to controller actions would unlock `artisan route:cache`.
if [ "${APP_ENV:-}" = "production" ]; then
    php artisan config:cache 2>/dev/null || \
        echo "entrypoint: config:cache failed — continuing with uncached config" >&2
fi

exec "$@"
