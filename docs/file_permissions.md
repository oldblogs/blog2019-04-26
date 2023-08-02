## Set file permissions.

```bash
cd ~
nano <domain_name>.sh
```
Copy & Paste the following code  check, save, and exit.

```bash
#!/usr/bin/env bash

SYSUSER='vmuser1'
WEBUSER='www-data'
WEBGROUP=$WEBUSER
SITEFOLDER='<domain_name>'
PUBLIC_DIR='public'

sudo usermod -a -G $WEBGROUP $SYSUSER

# Revoke all permissions
# sudo setfacl -R -bk /var/www/$SITEFOLDER

# Take ownership of the directory
sudo chown -hR $SYSUSER:$WEBGROUP /var/www/$SITEFOLDER

# Set new files' group to www-data
sudo find /var/www/$SITEFOLDER -type d -exec chmod g+s {} ";"

# Set write permission to www-data group on selected directories
sudo setfacl -R -m u::rwX -m g::rwX -m o::r-- /var/www/$SITEFOLDER/
sudo setfacl -dR -m u::rwX -m g::rwX -m o::r-- /var/www/$SITEFOLDER/

sudo setfacl -R -m u::rwX -m g::rwX -m o::r-X /var/www/$SITEFOLDER/storage/
sudo setfacl -dR -m u::rwX -m g::rwX -m o::r-X /var/www/$SITEFOLDER/storage/

sudo setfacl -R -m u::rwX -m g::rwX -m o::r-X /var/www/$SITEFOLDER/bootstrap/cache/
sudo setfacl -dR -m u::rwX -m g::rwX -m o::r-X /var/www/$SITEFOLDER/bootstrap/cache/
```

### Make executable
```bash
chmod u+x <domain_name>.sh
```

### Execute the script:
```bash
sudo ./<domain_name>.sh
```
