FROM php:8.3-fpm-alpine3.19

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    autoconf \
    g++ \
    make \
    linux-headers \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install gd pdo_mysql mysqli zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Expose necessary ports
EXPOSE 8000 9000

# Copy application files (assuming the app code is in the same directory as Dockerfile)
COPY . /var/www/html

# Command to start PHP-FPM
CMD ["php-fpm"]