FROM php:8.2-fpm

WORKDIR /var/www/html

# System deps + Node 20 (ONCE, correctly)
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# PHP deps
RUN composer install --no-dev --optimize-autoloader

# 🔥 Frontend build (this MUST succeed)
RUN npm install
RUN npm run build

# Clear caches AFTER build
RUN php artisan config:clear \
    && php artisan view:clear \
    && php artisan cache:clear \
    && php artisan route:clear 

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=${PORT}

