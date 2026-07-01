FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - && apt-get install -y nodejs


RUN chown -R www-data:www-data /var/www

COPY --chown=www-data:www-data . /var/www

USER www-data

RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN npm install && npm run build


EXPOSE 9000
CMD ["php-fpm"]
