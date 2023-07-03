#!/bin/bash

# Step 1: Update the system package list
sudo apt-get update

# Step 2: Install MySQL Server and Client
sudo apt-get install -y mysql-server mysql-client

# Step 3: Secure the MySQL installation
sudo mysql_secure_installation

# Step 4: Enable password for root user
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'admin123'; FLUSH PRIVILEGES;"

# Step 5: Start and enable the MySQL service
sudo systemctl start mysql
sudo systemctl enable mysql

# Step 6: Print MySQL version and status
mysql --version
sudo systemctl status mysql
