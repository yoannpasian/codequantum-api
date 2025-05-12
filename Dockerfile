FROM php:8.1-apache

# Copie des fichiers de l'application dans le répertoire par défaut d'Apache
COPY . /var/www/html/

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql
