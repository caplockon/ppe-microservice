#!/usr/bin/env bash

# Create .env file from system variable, workaround solution since Lumen does not work properly
# This solution to apply to production env only
echo "Copying env variable to .env file ..."


echo "Changing storage permission ..."
chmod -R 777 /var/www/html/storage
chown -R www-data:www-data /var/www/html

su www-data -s /bin/bash -c 'php artisan migrate --force'
apache2-foreground
