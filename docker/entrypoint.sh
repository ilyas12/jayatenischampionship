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
if [ -n "${DB_HOST:-}" ]; then
    echo "entrypoint: waiting for database at ${DB_HOST}..."
    for i in $(seq 1 60); do
        if mysqladmin ping -h"${DB_HOST}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" --silent >/dev/null 2>&1; then
            echo "entrypoint: database is up"
            break
        fi
        sleep 2
    done
fi

exec "$@"
