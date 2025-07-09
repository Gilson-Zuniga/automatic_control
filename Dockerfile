# Usa imagen oficial de PHP con Apache y extensiones necesarias
FROM php:8.2-cli

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip

# Instala Composer manualmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece directorio de trabajo
WORKDIR /app

# Copia todo el proyecto
COPY . .

# Asegura permisos para Laravel
RUN chmod -R 775 storage bootstrap/cache

# Instala dependencias con Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Exponer puerto que usará Laravel
EXPOSE 8000

# Ejecuta script de inicio
CMD ["sh", "./start.sh"]
