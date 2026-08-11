# Laravel 5.4 + illuminate/html 5.0 + folklore/image 0.2 are pinned to the
# PHP 5.6/7.0/7.1 era. 7.1 is the newest interpreter this stack runs clean on:
# 7.2 turns Laravel 5.4's count()/each() usage into notices and warnings that
# render into the page while APP_DEBUG is on.
FROM php:7.1-apache

# php:7.1-apache is built on Debian buster, which is past EOL: deb.debian.org
# no longer serves it, so apt-get update 404s. Repoint at the archive and stop
# apt rejecting the (necessarily stale) release metadata.
RUN printf '%s\n' \
        'deb http://archive.debian.org/debian buster main' \
        'deb http://archive.debian.org/debian-security buster/updates main' \
        > /etc/apt/sources.list \
    && printf 'Acquire::Check-Valid-Until "false";\n' > /etc/apt/apt.conf.d/99no-check-valid-until

RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        zlib1g-dev \
        default-mysql-client \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# gd backs folklore/image + imagine (the CMS resizes uploads on the fly).
RUN docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        pdo_mysql \
        mysqli \
        mbstring \
        exif \
        zip

RUN a2enmod rewrite headers

COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

WORKDIR /var/www/html

ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]
