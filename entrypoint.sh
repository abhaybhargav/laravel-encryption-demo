#!/bin/bash

# Check if artisan file exists
if [ -f "artisan" ]; then
    php artisan migrate --force
    php artisan key:generate --force
    php artisan config:cache
    php artisan package:discover --ansi
else
    echo "artisan file not found"
fi

# Execute the main command (e.g., Apache server)
exec "$@"
