FROM php:8.2-fpm

ARG APP_ENV=production
ENV APP_ENV=${APP_ENV}

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev libjpeg-dev libfreetype6-dev libssl-dev \
    libcurl4-openssl-dev libicu-dev libxslt1-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project (everything)
COPY . .

# Install dependencies
RUN if [ "$APP_ENV" = "production" ]; then \
      composer install --no-dev --optimize-autoloader; \
    else \
      composer install; \
    fi

# Permissions: ONLY for non-PVC folders
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 bootstrap/cache

# PHP-FPM listens on 9000
EXPOSE 9000

CMD ["php-fpm"]
