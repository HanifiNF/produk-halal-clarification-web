# Step 1: Use PHP 8.1 FPM image
FROM php:8.1-fpm

WORKDIR /var/www/html

# Step 2: Install system dependencies + Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Step 3: Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Step 4: Copy app files
COPY . .

# Step 5: Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Step 6: Install Node dependencies & build frontend assets
RUN npm install
RUN npm run build

# Step 7: Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Step 8: Expose port and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
