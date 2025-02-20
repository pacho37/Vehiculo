# Imagen base con PHP y Apache
FROM php:8.3-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y unzip libpq-dev && \
    docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Crear el archivo .env si no existe
RUN cp .env.example .env || true

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Generar clave de aplicación solo si el .env existe
RUN if [ -f ".env" ]; then php artisan key:generate; fi

# Dar permisos a storage y bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Exponer el puerto 8000
EXPOSE 8000

RUN mkdir -p /var/data && touch /var/data/database.sqlite && chmod 777 /var/data/database.sqlite

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}