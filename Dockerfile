# Imagen base con PHP y Apache
FROM php:8.3-apache

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y unzip libpq-dev && \
    docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Generar clave de aplicación
RUN php artisan key:generate

# Dar permisos a storage y bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]