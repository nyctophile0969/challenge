# Gunakan image base PHP dengan versi tertentu
FROM php:8.2-fpm-alpine

# Install dependensi yang diperlukan
RUN apk add --no-cache \
    php-curl \
    bash \
    curl \
    git \
    sqlite \
    sqlite-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Set working directory
WORKDIR /var/www/html

# Salin aplikasi ke container
COPY . .

# Set permissions (jika diperlukan)
RUN chown -R www-data:www-data /var/www/html

RUN mv /var/www/html/database /

# Expose port 9000 (default untuk PHP-FPM)
EXPOSE 9000

# Perintah untuk menjalankan PHP-FPM
CMD ["php-fpm"]