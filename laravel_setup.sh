#!/bin/bash

# Specify the project directory and Apache virtual host name
PROJECT_DIR="$(dirname "$(dirname "$(readlink -fm "$0")")")"
VIRTUAL_HOST="laravel.local"

# Step 1: Install Apache
sudo apt-get update
sudo apt-get install -y apache2

# Step 2: Install necessary PHP dependencies
sudo apt-get install -y php libapache2-mod-php php-mysql

# Step 3: Enable Apache modules
sudo a2enmod rewrite

# Step 4: Set up the virtual host in Apache
echo "
<VirtualHost *:80>
    ServerName $VIRTUAL_HOST
    DocumentRoot $PROJECT_DIR/public

    <Directory $PROJECT_DIR/public>
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/$VIRTUAL_HOST.conf

# Step 5: Enable the virtual host and restart Apache
sudo a2ensite $VIRTUAL_HOST.conf
sudo service apache2 restart

# Step 6: Install necessary Laravel dependencies
cd "$PROJECT_DIR"
composer install

# Step 7: Set proper permissions for Laravel directories
sudo chown -R www-data:www-data $PROJECT_DIR/storage
sudo chmod -R 775 $PROJECT_DIR/storage

sudo chown -R www-data:www-data $PROJECT_DIR/bootstrap/cache
sudo chmod -R 775 $PROJECT_DIR/bootstrap/cache

# Step 8: Run database migrations (if needed)
php artisan migrate

# Step 9: Start the Laravel development server
php artisan serve
