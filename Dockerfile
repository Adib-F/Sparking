# Gunakan base image dari Laravel Sail (PHP + Composer + Node)
FROM laravelsail/php83-composer:latest

# Install dependensi tambahan
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    nodejs \
    npm \
    netcat \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Tentukan direktori kerja
WORKDIR /var/www

# Copy semua file Laravel ke dalam image
COPY . .

# Install dependency PHP
RUN composer install --no-dev --optimize-autoloader

# Install dan build asset frontend
RUN npm install && npm run build

# Jalankan cache Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Set permission folder Laravel
RUN chmod -R 775 storage bootstrap/cache

# Buka port untuk Railway
EXPOSE 8000

CMD ["sh", "-c", "echo DB_HOST=$DB_HOST && echo DB_PORT=$DB_PORT && until nc -z $DB_HOST $DB_PORT; do echo 'Waiting for MySQL...'; sleep 2; done; php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
