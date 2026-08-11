# The interpreter is a build arg because the Laravel 5.4 -> 11 upgrade moves
# through PHP 7.1 -> 7.2 -> 7.3 -> 8.0 -> 8.1 -> 8.2. Set PHP_VERSION in
# docker-compose.yml (or via --build-arg) for the version the code targets.
#
# Laravel 5.4 needs 7.1: on 7.2+ its count()/each() usage emits warnings that
# render into the page.
ARG PHP_VERSION=7.1

# Composer 2.2 is the LTS line that still supports PHP 7.1. Later steps can
# raise this to 2 once the app is on 7.2.5+. Declared before the first FROM so
# it can be interpolated into a stage reference.
ARG COMPOSER_VERSION=2.2
FROM composer:${COMPOSER_VERSION} AS composer

FROM php:${PHP_VERSION}-apache

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
        libzip-dev \
        zlib1g-dev \
        default-mysql-client \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# gd backs the CMS image pipeline (folklore/image + imagine today,
# intervention/image after the upgrade). Its configure flags were renamed in
# PHP 7.4.
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
