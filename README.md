# carzon

This is a dummy project which consists of user module and some reports related to cab booking services.

# Important details

APP_NAME=Carzon

APP_ENV=local

**Need to generate using `php artisan key:generate`**
APP_KEY=

APP_URL=http://localhost:8000

LOG_CHANNEL=stack

**This database connection consists user module information and booking information.**
DB_CONNECTION=mysql
DB_HOST=remotemysql.com
DB_PORT=3306
DB_DATABASE=t5QtKKPwbw
DB_USERNAME=t5QtKKPwbw
DB_PASSWORD=aN2moxkLl2

**Mail driver setup for sending mails to user**

MAIL_DRIVER=
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_NAME=
MAIL_FROM_ADDRESS=

**Super admin email needs to be set.**

SUPER_ADMIN_EMAIL=dashboard.super.carzon

## Commands to be performed while doing fresh setup:-

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
```
