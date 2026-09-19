#!/bin/sh
# Update Apache port configuration dynamically
sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT:-80}>/g" /etc/apache2/sites-available/000-default.conf

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute main Apache command
exec "$@"