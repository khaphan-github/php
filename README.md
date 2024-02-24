## Do This:
https://docs.github.com/en/enterprise-cloud@latest/codespaces/setting-up-your-project-for-codespaces/adding-a-dev-container-configuration/setting-up-your-php-project-for-codespaces#step-4-run-your-application

## Start this project
```bash
cd ecm && php artisan serve
```

```bash
# run cai nay de setup connect to pgsql
# https://copyprogramming.com/howto/configure-error-cannot-find-libpq-fe-h-please-specify-correct-postgresql-installation-path
sudo apt-get update
sudo apt-get install wget ca-certificates
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | sudo apt-key add -
sudo sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" >> /etc/apt/sources.list.d/pgdg.list'

sudo apt-get install postgresql
sudo apt-get install libpq-dev
sudo docker-php-ext-install pgsql

touch /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini
echo "extension=pdo_pgsql" > /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini
cat /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini

sudo docker-php-ext-install pdo_pgsql
php artisan migrate
```