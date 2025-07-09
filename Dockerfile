FROM php:8.2-cli

# 1. Instala dependencias del sistema y extensiones necesarias
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
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd bcmath mbstring zip

# 2. Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 3. Define directorio de trabajo
WORKDIR /app

# 4. Copia archivos del proyecto
COPY . .

# 5. Permisos necesarios
RUN chmod -R 775 storage bootstrap/cache

# 6. Instala dependencias PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 7. Copia el archivo .env base
RUN cp .env.example .env

# 8. Genera clave de aplicación
RUN php artisan key:generate

# ✅ 9. Instala dependencias de Node.js y compila Vite
RUN npm install
RUN npm run build

# 10. Expone el puerto 8000 (por si usas Artisan serve)
EXPOSE 8000

# 11. Comando de inicio (cambia si usas Apache/Nginx)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
