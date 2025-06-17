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
    netcat-openbsd \
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
# RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Set permission folder Laravel
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["sh", "-c", "\
  echo 'Menunggu koneksi ke MySQL di $DB_HOST:$DB_PORT...' && \
  while ! nc -z \"$DB_HOST\" \"$DB_PORT\"; do \
    echo 'MySQL belum siap, menunggu...' && sleep 5; \
  done && \
  echo '✅ MySQL terkoneksi, lanjut migrasi...' && \
  php artisan migrate --force || { echo '❌ Migrasi gagal!'; exit 1; } && \
  echo '✅ Migrasi selesai, lanjut cache...' && \
  php artisan config:clear && \
  php artisan cache:clear && \
  php artisan config:cache && \
  php artisan route:cache && \
  php artisan view:cache && \
  echo '🚀 Menjalankan Laravel server...' && \
  php artisan serve --host=0.0.0.0 --port=8080 \
"]
