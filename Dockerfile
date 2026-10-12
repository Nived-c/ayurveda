# Build PHP dependencies separately so they can be cached by the hosting platform.
FROM composer:2 AS composer_dependencies
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --optimize-autoloader

# Build Vite assets for production.
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

FROM php:8.2-apache
WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends libpng-dev libzip-dev unzip \
    && docker-php-ext-install gd pdo_mysql zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY . .
COPY --from=composer_dependencies /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build
COPY docker/apache-vhost.conf /etc/apache2/conf-available/laravel.conf
COPY docker/entrypoint.sh /usr/local/bin/laravel-entrypoint

RUN a2enconf laravel \
    && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && chmod +x /usr/local/bin/laravel-entrypoint \
    && chown -R www-data:www-data storage bootstrap/cache

ENTRYPOINT ["laravel-entrypoint"]
CMD ["apache2-foreground"]

