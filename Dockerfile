FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key if needed
RUN php artisan key:generate || true

# Expose Render port
EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT