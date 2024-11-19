# Använd en PHP-bild med Apache för webserver
FROM php:8.1-apache

# Installera PDO och MySQL-tillägg för PHP
RUN docker-php-ext-install pdo pdo_mysql

# Kopiera applikationsfilerna till containern
COPY . /var/www/html/

# Ge rättigheter till Apache
RUN chown -R www-data:www-data /var/www/html
