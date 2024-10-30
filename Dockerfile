# Use official PHP image as base
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files to container
COPY . .

# Install dependencies with Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy existing application environment file
COPY .env.example .env

# Generate application key
RUN php artisan key:generate

# Copy the custom php.ini file
COPY ./docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
