# Mello Media (_Laravel 10 version_)
---

## Technology:
- [Laravel](https://laravel.com/) - The PHP Framework
- [MySQL](https://www.mysql.com/) - Open source database
- [MongoDB](https://www.mongodb.com/) - Open source database

## Initializing (main):
```sh
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan apikey:generate media
php artisan storage:link
```

## Relations:
- [AUTH](https://gitlab.com/MelloInteractive/auth) - Authentication gateway
