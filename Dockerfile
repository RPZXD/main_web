# Dockerfile
# Custom PHP image with Apache, PDO MySQL extension, and mod_rewrite enabled

FROM php:8.2-apache

# Install PDO MySQL database drivers
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache Mod Rewrite for clean routing
RUN a2enmod rewrite

# Setup apache root configuration directory context if required
WORKDIR /var/www/html

EXPOSE 80
