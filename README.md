
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

