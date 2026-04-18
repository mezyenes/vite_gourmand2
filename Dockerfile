FROM php:8.2-apache

# Activer mod rewrite (MVC routes)
RUN a2enmod rewrite

# Installer extensions MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier ton projet dans Apache
COPY . /var/www/html/

# Autoriser .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Port du serveur
EXPOSE 80