#!/bin/bash
set -e

# storage/ and bootstrap/cache come in over a bind mount owned by the host
# user, but Apache runs as www-data. Make them writable either way.
for dir in storage bootstrap/cache; do
    if [ -d "/var/www/html/$dir" ]; then
        chown -R www-data:www-data "/var/www/html/$dir" 2>/dev/null || true
        chmod -R a+rwX "/var/www/html/$dir" 2>/dev/null || true
    fi
done

# Laravel 5.4 expects these to exist; they are gitignored so a fresh checkout
# may be missing them.
mkdir -p \
    /var/www/html/storage/framework/{cache,sessions,views} \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache 2>/dev/null || true

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
                new PDO(
                    "mysql:host=".getenv("DB_HOST").";dbname=".getenv("DB_DATABASE"),
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

exec "$@"
