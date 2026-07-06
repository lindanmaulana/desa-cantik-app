# ===========================
# Stage 1 - Frontend Builder
# ===========================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.* ./
COPY tailwind.config.* ./
COPY postcss.config.* ./

RUN npm run build


# ===========================
# Stage 2 - Composer Builder
# ===========================
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --classmap-authoritative \
    --no-interaction \
    --no-scripts

COPY . .

RUN composer dump-autoload \
    --optimize \
    --classmap-authoritative


# ===========================
# Stage 3 - Production Image
# ===========================
FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        bcmath \
        exif \
        gd \
        zip \
        intl \
        opcache \
    && apt-get purge -y \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*

RUN { \
    echo "upload_max_filesize=10M"; \
    echo "post_max_size=10M"; \
    echo "memory_limit=256M"; \
    echo "opcache.enable=1"; \
    echo "opcache.memory_consumption=256"; \
    echo "opcache.max_accelerated_files=20000"; \
    echo "opcache.validate_timestamps=0"; \
    echo "opcache.revalidate_freq=0"; \
} > /usr/local/etc/php/conf.d/production.ini

COPY --chown=www-data:www-data . .

COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor

COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/testing \
    storage/logs \
    bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
