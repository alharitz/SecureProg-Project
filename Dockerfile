# Use official PHP image with PHP 8.2
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    nodejs \
    npm  # Add Node.js and npm

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy custom PHP configurations
COPY ./docker/local.ini /usr/local/etc/php/conf.d/

# Set up work directoryg
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install project dependencies
RUN composer install
RUN npm install && npm run build  # Install Node dependencies and build assets

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
