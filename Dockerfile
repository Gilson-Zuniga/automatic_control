# Etapa 1: Build de frontend con Node.js
FROM node:20 as nodebuilder

WORKDIR /app

# Copia los archivos necesarios
COPY package*.json vite.config.js ./
COPY resources/ resources/
COPY public/ public/

# Instala dependencias de Node y construye assets
RUN npm install  
RUN npm run build

# Etapa 2: PHP con Composer y extensiones
FROM php:8.2-cli

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libpq-dev \
    libxml2-dev \
    zip \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd bcmath mbstring zip

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece directorio de trabajo
WORKDIR /app

# Copia todo el proyecto Laravel
COPY . .

# Copia los assets construidos desde la primera etapa
COPY --from=nodebuilder /app/public/build public/build

# Da permisos a carpetas necesarias
RUN chmod -R 775 storage bootstrap/cache

# Instala dependencias PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Crea archivo .env si no existe
RUN cp .env.example .env

# Genera clave de aplicación
RUN php artisan key:generate

# Expone el puerto
EXPOSE 8000

# Comando para iniciar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
