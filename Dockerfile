FROM php:8.0-apache
# Establece el directorio de trabajo en el contenedor

WORKDIR /var/www/html/

# Copia el código de tu aplicación al directorio del servidor web en el contenedor
COPY . /var/www/html/

RUN docker-php-ext-install pdo_mysql

EXPOSE 80
