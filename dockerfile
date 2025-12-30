FROM php:8.2-cli

WORKDIR /var/www

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libpq-dev zip \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000

RUN php artisan migrate --force || true
