#!/bin/bash
sudo chown -R ec2-user:apache /var/www/html/update

cd /var/www/html/update

mkdir -p storage/logs
mkdir -p storage/app/public
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views

# Run composer
composer update

# Run npm
npm update
