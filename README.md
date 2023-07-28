blog2019-04-26 is a blog application made with Laravel, and Vue . It is in early development stage, so may not be suitable for production use. You can follow the steps below, and test it in your local computer.

### Requirements:
- A computer that can run VirtualBox or Qemu&libvirt
- Ubuntu 18.04 (Developed on this system, did not tested on another system yet.)
- Laravel 5.7 requirements
  - Apache
  - MySQL
  - PHP 7.1.3
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
# Installation of the blog app on local development virtual machine

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


References:
---

