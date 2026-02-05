FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip nginx nodejs npm \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copy project
COPY . .

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Frontend build (Vite Laravel)
RUN npm install
RUN npm run build

# Permissions (WAJIB)
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 8080

CMD service nginx start && php-fpm
