# Use the official PHP image with FPM and Nginx
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev libjpeg-dev libfreetype6-dev libmcrypt-dev libssl-dev \
    libcurl4-openssl-dev libicu-dev libxslt1-dev nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel project files
COPY . .

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions for Laravel directories
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Expose PHP-FPM and Nginx ports
EXPOSE 9000
EXPOSE 80

# Start PHP-FPM and Nginx in the foreground
CMD service nginx start && php-fpm -F
