FROM php:8.2-fpm

# Declare build-time and runtime environment early
ARG APP_ENV=production
ENV APP_ENV=${APP_ENV}

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev libjpeg-dev libfreetype6-dev libssl-dev \
    libcurl4-openssl-dev libicu-dev libxslt1-dev nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

ARG APP_ENV=production
RUN if [ "$APP_ENV" = "production" ]; then \
      composer install --optimize-autoloader --no-dev; \
    else \
      composer install; \
    fi


# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Expose ports
EXPOSE 9000
EXPOSE 80

# Start services
CMD service nginx start && php-fpm -F
