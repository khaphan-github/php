# Run your application

- Step 1: In the Terminal of your codespace, enter:

  ```
  sudo sed -i 's/Listen 80$//' /etc/apache2/ports.conf
  ```

- Step 2: Then, enter:

  ```
  sudo sed -i 's/<VirtualHost \*:80>/ServerName 127.0.0.1\n<VirtualHost \*:8080>/' /etc/apache2/sites-enabled/000-default.conf
  ```

- Step 3: Then start Apache using its control tool:

  ```
  apache2ctl start
  ```

- Step 4:

  When your project starts, you should see a "toast" notification message at the bottom right corner of VS Code, telling you that your application is available on a forwarded port.
  To view the running application, click Open in Browser.

- Step 5:

  ```
  # run cai nay de setup connect to pgsql
  # https://copyprogramming.com/howto/configure-error-cannot-find-libpq-fe-h-please-specify-correct-postgresql-installation-path

  sudo apt-get update
  sudo apt-get install wget ca-certificates
  wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | sudo apt-key add -
  sudo sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" >> /etc/apt/sources.list.d/pgdg.list'

  sudo apt-get install postgresql
  sudo apt-get install libpq-dev
  sudo docker-php-ext-install pgsql

  sudo touch /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini
  sudo echo "extension=pdo_pgsql" > /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini
  sudo cat /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini

  sudo docker-php-ext-install pdo_pgsql
  ```

- Step 6:

  ```
  php artisan migrate
  php artisan serve #run project

  ```
