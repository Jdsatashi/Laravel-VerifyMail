FROM php:8.1-fpm

# Install extension
RUN apt-get update && apt-get install -y \
        curl \
        git \
        unzip \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
        && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
