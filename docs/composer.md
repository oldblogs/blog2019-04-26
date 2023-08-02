## Composer
- PHP must be already installed before.

```bash
cd ~
```

- Install composer.
  - Follow instruction at the following link
    - https://getcomposer.org/download/

- Set path for composer:

```bash
nano ~/.profile
PATH=$HOME/.config/composer/vendor/bin:$PATH
export PATH
```
Save & Exit

### Install php packages
```bash
cd /var/www/<domain_name>
composer install
```

### Update php packages
```bash
cd /var/www/<domain_name>
composer update
```