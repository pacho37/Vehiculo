# Imagen base de PHP con Apache
FROM php:8.3-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar archivos de Laravel al contenedor
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Dar permisos a storage y bootstrap
RUN chmod -R 777 storage bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]