FROM php:8.3-fpm

RUN apt-get update  \
    && apt-get install -y git unzip libzip-dev libonig-dev libicu-dev zlib1g-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip intl xml
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-interaction --prefer-dist --no-suggest --optimize-autoloader

EXPOSE 9000
CMD ["php-fpm", "-R"]