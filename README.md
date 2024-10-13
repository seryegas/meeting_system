### Система совещаний и заседаний

#### запуск приложения
```shell
docker-composer up
```

#### выполнение миграций БД и заполнение данных
```shell
docker exec laravel_app php artisan migrate
docker exec laravel_app php artisan db:seed --class="IndustrySeeder"
docker exec laravel_app php artisan db:seed --class="RolesSeeder"
```
