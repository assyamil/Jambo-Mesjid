FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip nodejs npm nginx \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copy project
COPY . .

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install node deps & build assets
RUN npm install
RUN npm run build

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 8080

CMD service nginx start && php-fpm
