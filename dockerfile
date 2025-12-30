FROM php:8.2-cli

WORKDIR /var/www

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libpq-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Install Node.js deps
RUN npm install

# Build assets with Vite
RUN npm run build

# Clear Laravel caches
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Create a startup script
RUN echo "#!/bin/bash" > /start.sh
RUN echo "set -e" >> /start.sh
RUN echo "php artisan migrate --force || echo \"Migration failed or not needed\"" >> /start.sh
RUN echo "php artisan serve --host=0.0.0.0 --port=10000" >> /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
