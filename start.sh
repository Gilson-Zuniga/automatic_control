#!/bin/sh

# Copia .env si no existe
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Genera clave de la app
php artisan key:generate --force

# Ejecuta migraciones obligatorias
php artisan migrate --force

# Inicia el servidor Laravel
php artisan serve --host=0.0.0.0 --port=8000
