#!/bin/bash
set -euo pipefail
cd /var/www/html/update

# Delete useless files
rm -rf appspec.yml
rm -rf README.md
rm -rf scripts

# Delete test files
rm -rf tests
rm -rf phpunit.xml

# Optimize config, routes and views
php artisan optimize

# Copy local sessions if present
[ ! -f /var/www/html/martipansapte/storage/framework/sessions/ ] || mv /var/www/html/martipansapte/storage/framework/sessions/* /var/www/html/update/storage/framework/sessions

# Move current version folder, if present, to backup folder
[ ! -f /var/www/html/martipansapte/ ] || mv /var/www/html/martipansapte/ /var/www/html/old

# Copy the update folder to current version folder
rsync -a /var/www/html/update/ /var/www/html/martipansapte/

sudo mv supervisord.conf /etc/supervisord.conf

# Enter current version folder
cd /var/www/html/martipansapte

# Ensure correct file permissions
sudo chmod -R 774 storage

# Recreate public storage symlink 
php artisan storage:link

# Delete update folder
sudo rm -rf /var/www/html/update

# Delete backup folder
sudo rm -rf /var/www/html/old

php artisan migrate --force --no-interaction

SEED_FLAG="/martipansapte/local/seeded"

if ! aws ssm get-parameter --name "$SEED_FLAG" >/dev/null 2>&1; then
  # best-effort lock: attempt to create the parameter without overwrite
  if aws ssm put-parameter --name "$SEED_FLAG" --type String --value "pending" --tags Key=App,Value=martipansapte >/dev/null 2>&1; then
    php artisan db:seed --force --no-interaction
    aws ssm put-parameter --name "$SEED_FLAG" --type String --value "$(date -Is)" --overwrite >/dev/null
  else
    echo "Another instance is seeding (or already seeded). Skipping."
  fi
else
  echo "Seed already performed. Skipping."
fi

(crontab -l 2>/dev/null | grep -v 'php artisan schedule:run'; echo "* * * * * cd /var/www/html/martipansapte && php artisan schedule:run >> /dev/null 2>&1") | crontab -

# Start supervisord
sudo systemctl start supervisord