#!/bin/bash
set -e

echo "Waiting for database connection..."
max_attempts=30
attempt=0
until php -r "
    try {
        \$pdo = new PDO(
            'mysql:host=${DB_HOST};port=${DB_PORT:-3306};dbname=${DB_NAME}',
            '${DB_USER}',
            '${DB_PASS}'
        );
        echo 'Connected';
    } catch (Exception \$e) {
        exit(1);
    }
" 2>/dev/null; do
    attempt=$((attempt + 1))
    if [ $attempt -ge $max_attempts ]; then
        echo "Database connection failed after $max_attempts attempts"
        exit 1
    fi
    echo "Attempt $attempt/$max_attempts failed, retrying in 2s..."
    sleep 2
done

echo "Database connected. Running migrations..."
php /var/www/html/bin/migrate.php

echo "Starting service..."
exec "$@"
