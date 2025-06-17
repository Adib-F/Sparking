# Gunakan base image dari Laravel Sail (PHP + Composer + Node)
FROM laravelsail/php83-composer:latest

# Install dependensi tambahan
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    nodejs \
    npm

# Tentukan direktori kerja
WORKDIR /var/www

# Copy semua file Laravel ke dalam image
COPY . .

# Install dependency PHP
RUN composer install --no-dev --optimize-autoloader

# Install dan build asset frontend
RUN npm install && npm run build

# Jalankan cache Laravel (opsional tapi disarankan)
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Buka port untuk Railway
EXPOSE 8000

# Jalankan Laravel menggunakan built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
