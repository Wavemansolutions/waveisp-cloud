#!/bin/bash

set -e

echo "Starting WaveISP Laravel on Railway..."

php artisan serve --host=0.0.0.0 --port=${PORT:-8000}