# Usamos una imagen de PHP con Apache y extensiones necesarias
FROM php:8.3-apache

# Instalamos dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libsqlite3-dev \
    sqlite3 \
    && docker-php-ext-configure pdo_sqlite --with-pdo-sqlite=/usr \
    && docker-php-ext-install zip pdo pdo_sqlite

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto al contenedor
COPY . .

# Otorgar permisos a storage y bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Configurar la base de datos SQLite
RUN touch /var/www/html/storage/database.sqlite

# Configurar el puerto de Apache
EXPOSE 80

# Comando para iniciar Laravel en Apache
CMD ["apache2-foreground"]