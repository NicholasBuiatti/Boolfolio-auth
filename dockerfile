# PHP 8.2 + Apache
FROM php:8.2-apache

# Installa dipendenze di sistema e PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev pkg-config curl nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Abilita mod_rewrite di Apache
RUN a2enmod rewrite

# Imposta root Apache su public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copia Composer dal container ufficiale
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Imposta working directory
WORKDIR /var/www/html

# Copia sorgenti Laravel
COPY . /var/www/html

# Installa dipendenze Node e genera assets (Vite)
RUN npm install && npm run build

# Installa dipendenze PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev \
    && php artisan view:clear \
    && php artisan cache:clear \
    && php artisan config:clear

# Imposta permessi corretti
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/public \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Esponi porta 80
EXPOSE 80

# Comando di avvio Apache
CMD ["apache2-foreground"]
