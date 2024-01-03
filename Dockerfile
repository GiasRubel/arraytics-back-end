# Use the official PHP image with version 8.2.6 as the base image
FROM php:8.2.6-fpm

# Install required dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache

# Install Composer globally with version 2.6.5
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.6.5

# Set the working directory to /app
WORKDIR /app

# Copy the composer.json and composer.lock
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the application files to the container
COPY . .

# Generate the optimized autoloader and clear the cache
RUN composer dump-autoload --optimize && php artisan cache:clear

# Expose port 9000 and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
