FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y git curl libpng-dev zip unzip

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - && apt-get install -y nodejs

COPY . /var/www



docker-compose.yml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    image: pandawa-app:latest
    container_name: pandawa-app
    restart: unless-stopped
    tty: true
    volumes:
      - .:/var/www
    networks:
      - pandawa-network

  nginx:
    image: nginx:alpine
    container_name: pandawa_nginx
    restart: unless-stopped
    ports:
      - "8000:80"
    volumes:
      - .:/var/www
    command: /bin/sh -c "echo 'server { listen 80; index index.php; root /var/www/public; location ~ \.php$$ { fastcgi_pass app:9000; fastcgi_index index.php; include fastcgi_params; fastcgi_param SCRIPT_FILENAME $$document_root$$fastcgi_script_name; } location / { try_files $$uri $$uri/ /index.php?$$query_string; } }' > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'"
    networks:
      - pandawa-network
    depends_on:
      - app

  db:
    image: mysql:8.0
    container_name: pandawa_db
    restart: unless-stopped
    tty: true
    ports:
      - "3306:3306"
    environment:
      MYSQL_DATABASE: ${DB_DATABASE:-pandawa_db}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD:-pandawasecret}
      MYSQL_USER: ${DB_USERNAME:-pandawa_user}
      MYSQL_PASSWORD: ${DB_PASSWORD:-pandawasecret}
    volumes:
      - pandawa_mysql_data:/var/lib/mysql
    networks:
      - pandawa-network

networks:
  pandawa-network:
    driver: bridge

volumes:
  pandawa_mysql_data:
    driver: local
