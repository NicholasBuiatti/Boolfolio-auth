# PHP 8.2 + Apache
FROM php:8.2-apache

# Installa dipendenze PHP e sistema
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev pkg-config curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Installa Node.js e npm (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs

# Abilita mod_rewrite
RUN a2enmod rewrite

# Imposta root Apache su public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copia Composer dal container ufficiale
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Imposta working directory
WORKDIR /var/www/html

# Copia sorgenti Laravel
COPY . /var/www/html

# Install dependencies Node.js e build Vite
RUN npm install \
    && npm run build

# Installa dipendenze PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Imposta permessi corretti
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/public \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
