FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y git curl libpng-dev zip unzip

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - && apt-get install -y nodejs

COPY . /var/www



docker-compose.yml
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    image: pandawa-app:prod
    container_name: pandawa-app
    restart: always
    env_file:
      - .env
    networks:
      - pandawa-network

  nginx:
    image: nginx:alpine
    container_name: pandawa_nginx
    restart: always
    ports:
      - "80:80"
    volumes:
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www:ro
    networks:
      - pandawa-network
    depends_on:
      - app

  db:
    image: mysql:8.0
    container_name: pandawa_db
    restart: always
    environment:
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_USER: ${DB_USERNAME}
      MYSQL_PASSWORD: ${DB_PASSWORD}
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
