#!/usr/bin/env bash
set -euo pipefail

APP_DIR=${1:-itv-infra-crm}

composer create-project laravel/laravel "$APP_DIR" "^12.0"
cd "$APP_DIR"

composer require spatie/laravel-permission spatie/laravel-activitylog
composer require laravel/breeze --dev

php artisan breeze:install blade --no-interaction
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"

cp -R ../laravel-overlay/app ./
cp -R ../laravel-overlay/database ./
cp -R ../laravel-overlay/resources ./
cp ../laravel-overlay/routes/web.php ./routes/web.php

php artisan migrate --seed

if command -v npm >/dev/null 2>&1; then
  npm install
  npm run build
fi

echo "Instalada app en $APP_DIR"
