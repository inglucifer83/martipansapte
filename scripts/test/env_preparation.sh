#!/bin/bash

# Check for composer
composer -v > /dev/null 2>&1
COMPOSER=$?
if [[ $COMPOSER -ne 0 ]]; then
  cd /home/ec2-user

  EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"

  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  
  ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

  if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
  then
      >&2 echo 'ERROR: Invalid installer checksum'
      rm composer-setup.php
      exit 1
  fi

  php composer-setup.php --quiet
  RESULT=$?
  rm composer-setup.php

  sudo mv composer.phar /usr/local/bin/composer
fi

# Check update and old directories existence
if [ -d "/var/www/html/update" ]; then
  sudo rm -rf /var/www/html/update
fi

if [ -d "/var/www/html/old" ]; then
  sudo rm -rf /var/www/html/old
fi

mkdir /var/www/html/update
mkdir /var/www/html/old

sudo systemctl stop supervisord