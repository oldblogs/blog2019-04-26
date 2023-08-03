## Installation of the blog app on a virtual machine

### Description of computers:
  - **VM:** This is the virtual machine that runs the blog application.
    - **Directories:**
      - /var/www
        - Directory for new web sites. Create a new directory for a new web site.
    - **Users:**
      - www-data: The user/group that Apache uses.
      - vmuser1: System user with sudo privileges.
    - **`<IP address of VM>`**
      - Example: 192.168.1.55 . When you see `<IP address of VM>`, enter your VM's IP address without angle brackets.
    - **`<domain_name>`**
      - example.com may be used. When use see `<domain_name>`, enter a domain name you selected.
      - Database name: blogdb
      - Database user: bloguser

  - **Dev PC:** The computer we develop on (Host of the VM). 
    - **Directories:**
      - ~/projects: Local copies of projects
    - **Users:**
      - `<dev_user>` : System user with sudo privileges. When you see `<dev_user>` , enter your system user name without angle brackets.

  - Most of the processes will be on the VM. If the process is on the Dev PC, I will mention it in the title.

### Create a new Virtual Machine on Development PC
  - TODO: Create a VM

### Install requirements to the Virtual Machine
  - TODO: Install Ubuntu 18.04
    - TODO: Set up ssh daemon.
    - TODO: sshfs
  - TODO: Laravel 5.7 requirements
    - TODO: Apache, MySQL, PHP 7.1.3, Email, Git, unzip, p7zip-full, p7zip-rar, etc ...
    - [Composer](docs/composer.md)
      - PHP must be installed before this one.
    - [Node, npm](docs/node.md)
  - TODO: Setup for sending e-mails.
  - TODO: Git
    - There is two options for git.
      - Install git and set credentials on VM.
      - Install git and set credentials on Dev PC, use sshfs to manipulate files on VM.
      - I use the second one, so I do not have to setup my git credentials on VM.

Installation steps of requirements will be documented later.

### Create a new directory in /var/www

```bash
cd /var/www
mkdir <domain_name>
cd /var/www/<domain_name>
```

### [Set a remote directory on Dev PC that connects to VM](docs/sshfs.md)
- Click title to read the details.

### Clone the git repository on Dev PC
```bash
cd ~/projects/blog2019-04-26
./connect.sh
cd ~/projects/blog2019-04-26/remote
git clone git@github.com:oldblogs/blog2019-04-26.git ./
```
### [Set file permissions](docs/file_permissions.md)
- Click title to read the details.

### Generate application key
```bash
cd /var/www/<domain_name>
cp .env.example .env
php artisan key:generate
```
Check .env file APP_KEY value, it must not be empty. 

Note: Keep your attention on whitespaces in .env file. White space between characters causes problems.

### Laravel link storage
  From Laravel 5.7 documentation:

> https://laravel.com/docs/5.7/filesystem#the-public-disk
>
> To make them accessible from the web, you should create a symbolic link from public/storage to storage/app/public.

```bash
cd /var/www/<domain_name>
php artisan storage:link
# set file permissions
cd ~
sudo ./<domain_name>.sh
```

### [Apache httpd virtual host setting](docs/apache.md)
- Click title to read the details.

### Define site in /etc/hosts file on Dev PC
```bash
sudo nano /etc/hosts
<IP address of VM> <domain_name>
```
Save & exit.

Test
```bash
ping <domain_name>
```

### Install npm packages, and compile JS,and CSS

```bash
cd /var/www/<domain_name>
npm install
npm run dev
```

This installes npm packages, and compiles Javascript and CCS files.

### Create a database

```bash
$ mysql -u root -p
mysql> CREATE DATABASE blogdb CHARACTER SET utf8;
exit
```

### Create a database user

```bash
$ mysql -u root -p
CREATE USER bloguser@localhost IDENTIFIED BY 'password';
exit
```
Of course, enter your own 'password'.

### Grant privileges to the user
```bash
$ mysql -u root -p
GRANT ALL PRIVILEGES ON blogdb.* TO 'bloguser'@'localhost';
exit
```

### Migrate database
Edit /var/www/'<domain_name>'/.env file, change the following values.
```ini
APP_NAME=Blog
APP_ENV=development
APP_DEBUG=true
APP_URL=http://'<domain_name>'

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogdb
DB_USERNAME=bloguser
DB_PASSWORD=password
```

```bash
cd /var/www/<domain_name>
php artisan migrate:install --database=mysql
```

This creates the migrations table.

Execute the migrations:
```bash
php artisan migrate
```
This will execute scripts listed in migrations table, stored in database/migrations directory.

### Seed the database with initial records
```bash
cd /var/www/<domain_name>
php artisan db:seed 

Seeding: RolesAndPermissionsSeeder
Seeding: SocialprovidersSeeder
Seeding: CsocialSeeder
Seeding: MediumTypeSeeder
Seeding: LicenseSeeder
Seeding: MediumSeeder
Database seeding completed successfully.

```

### Email Settings

Create [mailtrap](https://mailtrap.io/) account and enter your mailtrap information into .env file.
(Mailtrap -> Email Testing -> Inboxes -> MyInbox -> SMTP Settings -> Show Credentials )
Integrations: Select Laravel 7+

.env file
```bash
MAIL_DRIVER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=mailtrap_user_name
MAIL_PASSWORD=mailtrap_password
MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS="info@<domain_name>"
MAIL_FROM_NAME="Blog"
```

There must be no whitespaces between characters.

### Fill Laravel Application caches (config, routes, views)
```bash
cd /var/www/<domain_name>
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Restart Apache
```bash
sudo service apache2 restart
```



References:
---

#### How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 18.04
https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04

#### Installing Node.js with Apt Using a NodeSource PPA
https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-18-04

#### Read about domain names
https://en.wikipedia.org/wiki/Domain_name

#### Git
https://git-scm.com/docs/git-clone

#### Computer code sign & symbol names exercise part 1 :wink:
http://www.blairenglish.com/exercises/technology_web/exercises/computer_code_symbols_signs_names_1/computer_code_symbols_signs_names_1.html

#### Complete list of github markdown emoji markup 
https://gist.github.com/rxaviers/7360908
