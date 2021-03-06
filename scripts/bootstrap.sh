#!/bin/bash

set -e

export DEBIAN_FRONTEND=noninteractive
apt-get update
# Don't apt-get upgrade http://stackoverflow.com/a/15093460/589391

# Limit mysql memory use for install
# https://mariadb.com/blog/starting-mysql-low-memory-virtual-machines
mkdir -p /etc/mysql/conf.d
cat > /etc/mysql/conf.d/low_mem.cnf << 'EOF'
[mysqld]
performance_schema = off
EOF

apt-get install -y mysql-server-5.6 nginx php5-cli php5-fpm php5-mysql php5-curl

echo 'Configuring mysql...'
mysql -uroot -e "CREATE DATABASE IF NOT EXISTS wp"

echo 'Configuring nginx...'
cat > /etc/nginx/sites-available/default << 'EOF'
server {
    server_name localhost;
    listen 80;

    root /vagrant/wp;
    index index.php index.html index.htm;
    try_files $uri $uri/ /index.php?q=$uri&$args;

    location /wp-content/ {
        root /vagrant;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
EOF

# https://abitwiser.wordpress.com/2011/02/24/virtualbox-hates-sendfile/
sed -i 's/sendfile on/sendfile off/' /etc/nginx/nginx.conf

echo 'Restarting nginx...'
/etc/init.d/nginx restart

echo 'Installing composer...'
curl -sS https://getcomposer.org/download/1.0.0-alpha10/composer.phar > /usr/local/bin/composer
chmod 755 /usr/local/bin/composer

echo 'Installing wp-cli...'
curl -sS https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar > /usr/local/bin/wp
chmod 755 /usr/local/bin/wp

echo 'Making /vagrant the login directory...'
cd /vagrant
su vagrant -c 'echo "cd /vagrant" >> /home/vagrant/.bashrc'

echo 'WordPress should be up and running at http://localhost:1515'
echo 'Follow the README for final setup.'
