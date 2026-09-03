FROM php:8.3-apache

# PHP extensions Grav needs (gd, zip, mbstring) + opcache; enable .htaccess rewrites
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev \
        unzip curl ca-certificates; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" gd zip opcache mbstring; \
    a2enmod rewrite; \
    sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf; \
    rm -rf /var/lib/apt/lists/*

# Download Grav + Admin (the "grav-admin" bundle ships the admin panel + vendor/)
RUN set -eux; \
    curl -fSL -o /tmp/grav.zip "https://getgrav.org/download/core/grav-admin/latest"; \
    unzip -q /tmp/grav.zip -d /tmp; \
    rm -f /var/www/html/index.html; \
    cp -a /tmp/grav-admin/. /var/www/html/; \
    rm -rf /tmp/grav-admin /tmp/grav.zip; \
    chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
