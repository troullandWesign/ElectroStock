# Image de base PHP avec Apache
FROM php:8.3-apache

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm

# Installation des extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration Apache
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers composer et installer les dépendances PHP
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copier les fichiers package.json et installer les dépendances Node
COPY package.json package-lock.json* ./
RUN npm install

# Copier tous les fichiers de l'application
COPY . .

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize

# Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exposition du port 80
EXPOSE 80

# Script de démarrage
CMD bash -c "php artisan config:cache && php artisan migrate --force && npm run build && apache2-foreground"
