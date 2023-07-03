## Install Apache 
echo "Installing Apache";

# Check Apache exisist 
sudo systemctl status apache2

# Install 
sudo apt install apache2

# If you use firewall if don't skip this 
# sudo ufw allow “Apache Full”

## Install PHP
echo "Installing PHP";

# Install php and dependencies 
sudo apt install php libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip php-bcmath php-tokenizer php-json php-pear php-curl php-mysql

# 

## Install SQL 
echo "Installing MySQL";

# Install 
sudo apt install mysql-server

# Secure Instalation 



## Install Composer 
echo "Installing Composer";

# Install 
curl -sS https://getcomposer.org/installer | php

sudo mv composer.phar /usr/local/bin/composer

sudo chmod +x /usr/local/bin/composer


## Install/ Deploy Laravel 

