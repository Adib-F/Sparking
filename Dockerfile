# Gunakan base image Laravel Sail
FROM laravelsail/php83-composer:latest

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    nodejs \
    npm \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Tentukan direktori kerja
WORKDIR /var/www

# Salin semua file ke dalam container
COPY . .

# Install dependency PHP (tanpa dev)
RUN composer install --no-dev --optimize-autoloader

# Jalankan migrasi, cache config
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Install dependensi front-end & build
RUN npm install && npm run build

# Set permission yang benar
RUN chmod -R 775 storage bootstrap/cache

# Port default Laravel
EXPOSE 8000

# Jalankan Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
