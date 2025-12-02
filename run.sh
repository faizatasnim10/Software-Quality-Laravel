#!/bin/bash

echo "==============================================="
echo "       Starting Laravel (student-api)"
echo "==============================================="

PROJECT_PATH="/d/MS CSE/Software Quality/Upload HW/HW4_3/project-stage2-submission/code/student-api"
cd "$PROJECT_PATH" || { echo "❌ Project folder not found!"; exit 1; }
echo "✔ Project folder found: $PROJECT_PATH"

echo "Installing PHP dependencies using Composer..."
composer install
if [ $? -ne 0 ]; then
    echo "❌ Composer install failed."
    exit 1
fi
echo "✔ Composer dependencies installed."

# Generate APP_KEY if missing
if ! grep -q "APP_KEY=" .env || [ -z "$(grep APP_KEY .env | cut -d '=' -f2)" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate
fi
echo "✔ APP_KEY is set."

# Fix permissions (mostly safe on Windows)
chmod -R 755 storage bootstrap/cache

# Check DB connection
php artisan migrate:status > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✔ Database connection OK. Clearing caches..."
    php artisan optimize:clear
    php artisan config:clear
else
    echo ⚠️ Database connection failed. Skipping cache clearing."
fi

# Open browser reliably
LARAVEL_URL="http://127.0.0.1:8080"
echo "Opening browser at $LARAVEL_URL ..."

if [[ "$OSTYPE" == "msys" ]] || [[ "$OSTYPE" == "cygwin" ]]; then
    cmd.exe /c start "$LARAVEL_URL"
elif [[ "$OSTYPE" == "linux-gnu"* ]]; then
    xdg-open "$LARAVEL_URL"
elif [[ "$OSTYPE" == "darwin"* ]]; then
    open "$LARAVEL_URL"
fi

# Start Laravel server (foreground, reliable)
echo "Starting Laravel server at $LARAVEL_URL ..."
php artisan serve --host=127.0.0.1 --port=8080