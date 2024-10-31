# Use official PHP 8.2 image as base
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files to container
COPY . .

# Install PHP dependencies with Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js dependencies (for Vite)
RUN npm install

# Build frontend assets with Vite for production
RUN npm run build

# Copy the .env example file and generate an application key
COPY .env.example .env
RUN php artisan key:generate

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
