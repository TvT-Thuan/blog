copy .env.example to .env
-  change name database db_blog
php artisan key:generate
php artisan migrate -seed
php artisan serve