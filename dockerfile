# Use the official PHP image as the base image with PHP 8.2
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Copy composer.lock and composer.json to install dependencies
COPY composer.lock composer.json /var/www/html/

# Install Composer (PHP dependency manager)
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Copy the Laravel application files to the working directory in the container
COPY . /var/www/html

# Install dependencies
RUN composer install


# Expose port 9000 and start php-fpm server
EXPOSE 9001
CMD ["php-fpm"]
