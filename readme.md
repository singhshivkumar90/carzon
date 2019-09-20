# Carzon

This project is a dummy project which consists of user module and dasboard report section about all the booking details.

# Important details

## ENV keys :

**Need to generate using `php artisan key:generate`**

APP_KEY=

**Need to set the local url**

APP_URL=

**This database connection consists user module information.**

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

**Mail driver setup for sending mails to user**

MAIL_DRIVER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_NAME=
MAIL_FROM_ADDRESS=

**Super admin email needs to be set.**

SUPER_ADMIN_EMAIL=


## Commands to be performed while doing fresh setup:-

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
```
