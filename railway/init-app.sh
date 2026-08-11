#!/bin/bash

set -e

echo "Running WaveISP production migrations..."
php artisan migrate --force

echo "Clearing old Laravel cache..."
php artisan optimize:clear

echo "Caching Laravel production files..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "WaveISP init complete."