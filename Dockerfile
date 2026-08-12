# Two build targets:
#
#   base/development  bind-mounts the source, opcache off  (docker-compose.yml)
#   production        bakes the source in, opcache on      (docker-compose.prod.yml)
#
# PHP_VERSION stays a build arg because this app was stepped from Laravel 5.4 on
# PHP 7.1 up to Laravel 13 on 8.3 one version at a time; the archived-Debian and
# pre-7.4 gd branches below keep those older versions buildable for bisecting.
ARG PHP_VERSION=8.3

# Declared before the first FROM so it can be interpolated into a stage
# reference. 2.2 is the last line supporting PHP 7.1, if you go back that far.
ARG COMPOSER_VERSION=2
FROM composer:${COMPOSER_VERSION} AS composer

FROM php:${PHP_VERSION}-apache AS base

# Debian releases older than bullseye are off deb.debian.org and only on
# archive.debian.org, so apt-get update 404s on the PHP 7.x images. Repoint
# those and stop apt rejecting the necessarily stale release metadata.
RUN set -eux; \
    codename="$(. /etc/os-release && echo "${VERSION_CODENAME:-}")"; \
    case "$codename" in \
        jessie|stretch|buster) \
            printf '%s\n' \
                "deb http://archive.debian.org/debian ${codename} main" \
                "deb http://archive.debian.org/debian-security ${codename}/updates main" \
                > /etc/apt/sources.list; \
            printf 'Acquire::Check-Valid-Until "false";\n' \
                > /etc/apt/apt.conf.d/99no-check-valid-until; \
            ;; \
    esac

RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        # mbstring stopped bundling oniguruma in PHP 7.4.
        libonig-dev \
        libzip-dev \
        zlib1g-dev \
        default-mysql-client \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# gd backs the CMS image pipeline (imagine/imagine). Its configure flags were
# renamed in PHP 7.4.
RUN set -eux; \
    if [ "$(php -r 'echo PHP_VERSION_ID;')" -lt 70400 ]; then \
        docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
    else \
        docker-php-ext-configure gd --with-freetype --with-jpeg; \
    fi; \
    docker-php-ext-install -j"$(nproc)" \
        gd \
        pdo_mysql \
        mysqli \
        mbstring \
        exif \
        zip

COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_MEMORY_LIMIT=-1

RUN a2enmod rewrite headers

COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

WORKDIR /var/www/html

ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]


# ---------------------------------------------------------------------------
# Development — the default target. Source arrives via a bind mount, so nothing
# is copied in; opcache stays off (docker/php/php.ini) so edits take effect on
# the next request.
# ---------------------------------------------------------------------------
FROM base AS development


# ---------------------------------------------------------------------------
# Production — source and dependencies baked into the image. No bind mount, no
# Composer at runtime, opcache on with timestamp validation off.
# ---------------------------------------------------------------------------
FROM base AS production

COPY docker/php/php.prod.ini /usr/local/etc/php/conf.d/zz-app.ini

# Dependencies first, so a source-only change does not re-resolve them.
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --no-interaction \
        --prefer-dist

COPY . .

# .env.docker holds development credentials and a development APP_KEY. It must
# never ship in an image: production configuration comes from the environment.
RUN rm -f .env .env.docker .env.example \
    && rm -rf .backup docker/mysql cms-template-engine.sql scripts tests \
    && composer dump-autoload --no-dev --optimize --classmap-authoritative

# Apache runs as www-data and the code is read-only to it; only the two paths
# Laravel writes to are owned by it.
RUN chown -R www-data:www-data storage bootstrap/cache \
    && find . -type d -exec chmod 755 {} + \
    && find . -type f -exec chmod 644 {} +

# Compiled Blade templates. Config and route caches are deliberately NOT built
# here: config:cache would bake in build-time environment values, and
# route:cache cannot work at all while routes/web.php and routes/api.php define
# closures. See docker/entrypoint.sh, which caches config at container start
# once the real environment is present.
RUN php artisan view:cache || true
