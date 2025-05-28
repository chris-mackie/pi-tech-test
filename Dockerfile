FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    pkg-config \
    zip \
    unzip \
    && docker-php-ext-install mbstring exif pcntl bcmath gd \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
