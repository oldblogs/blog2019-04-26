blog2019-04-26 is a blog application made with Laravel, and Vue . It is in early development stage, so may not be suitable for production use. You can follow the steps below, and test it in your local computer.

### Requirements:
- A computer that can run VirtualBox or Qemu&libvirt
- Ubuntu 18.04 (Developed on this system, did not tested on another system yet.)
- Laravel 5.7 requirements
  - Apache
  - MySQL
  - PHP 7.1.3
  - Node, npm
- Email  
- Git
- Ability to send e-mail

**Install unzip, 7zip .**

```bash
sudo apt update
sudo apt install unzip
sudo apt install p7zip-full p7zip-rar
```
Installation steps of requirements will be documented later.

---
## Installation of the blog app on local development virtual machine

Description for computers:
  - VM: This is the virtual machine that runs the blog application.
    - Also it can be a server in a datacenter. (With a few extra steps.)
  - Dev PC: This is computer we develop on. 

### Clone repository On VM

Create a new directory in /var/www directory on server.
```bash
cd /var/www
mkdir stage1.com
cd /var/www/stage1.com
git clone git@github.com:oldblogs/blog2019-04-26.git ./
```

Set file permissions.

### Composer on VM
- Install composer.
  - https://getcomposer.org/download/

- Set path for composer:

```bash
nano ~/.profile
PATH=$HOME/.config/composer/vendor/bin:$PATH
export PATH
```
Save & Exit

```bash
cd /var/www/stage1.com/
composer update
```

### Generate application key
```bash
cd /var/www/stage1.com/
cp .env.example .env
php artisan key:generate
```
Check .env file APP_KEY value, it must equal to the new key generated. 
Note: Keep your attention on whitespaces in .env file. White space between characters causes problems.

### Apache httpd virtual host setting
On VM

```bash
sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/stage1.conf
sudo nano /etc/apache2/sites-available/stage1.conf
```
file: /etc/apache2/sites-available/stage1.conf
```apache
<VirtualHost *:80>
        ServerAdmin webmaster@stage1.com
        ServerName stage1.com
        ServerAlias www.stage1.com
        DocumentRoot /var/www/stage1.com/public

        <Directory /var/www/stage1.com/public>
          Options -Indexes +FollowSymLinks -MultiViews
          AllowOverride All
          Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
```

```bash
sudo a2ensite stage1.conf
sudo service apache2 reload
```

### Define site in /etc/hosts file in Dev PC

```bash
sudo nano /etc/hosts
```
Add the following row to the file:
```bash
<IP address of youe VM> stage1.com
```
Enter your VM's IP address without angle brackets. Save&Exit.

Test

```bash
ping stage1.com
```

### Create a database on VM

```bash
$ mysql -u root -p
mysql> CREATE DATABASE stage1db CHARACTER SET utf8;
exit
```

### Create a database user on VM

```bash
$ mysql -u root -p
CREATE USER userstage1@localhost IDENTIFIED BY 'password';
exit
```
Of course, enter your own 'password'.


### Grant privileges to the user
```bash
$ mysql -u root -p
GRANT ALL PRIVILEGES ON stage1db.* TO 'userstage1'@'localhost';
exit
```

### npm update

```bash
cd /var/www/stage1.com
npm update
npm run dev
```

### Clear Laravel caches

```bash
cd /var/www/stage1.com
php artisan migrate:install --database=mysql
```

### Migrate database

Edit /var/www/stage1.com/.env file, change the following values.
```ini
APP_NAME=Stage1
APP_URL=http://stage1.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stage1db
DB_USERNAME=userstage1
DB_PASSWORD=your_password
```



References:
---

#### How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 18.04
https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04

#### Installing Node.js with Apt Using a NodeSource PPA
https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-18-04

#### Computer code sign & symbol names exercise part 1 :wink:
http://www.blairenglish.com/exercises/technology_web/exercises/computer_code_symbols_signs_names_1/computer_code_symbols_signs_names_1.html

#### Complete list of github markdown emoji markup 
https://gist.github.com/rxaviers/7360908
