FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip gd

# Aktifkan routing mod_rewrite Apache
RUN a2enmod rewrite

# Pindah ke direktori web
WORKDIR /var/www/html

# Ubah arah root Apache ke folder "public" Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy semua file proyek ke dalam server
COPY . .

# Install Composer dan jalankan dependensi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Beri izin akses untuk folder penting Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
