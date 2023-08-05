## [Back](../README.md)

## Add a user to a role

`<e-mail>` must belong to an already registered user.

```text
cd /var/www/<domain_name>
php artisan permission:assign-role admin <e-mail>

Role  : admin
User  : <e-mail>
Role succesfully set.
```

```text
php artisan permission:assign-role apiadmin <e-mail>
Role  : apiadmin
User  : <e-mail>
Role succesfully set.
```