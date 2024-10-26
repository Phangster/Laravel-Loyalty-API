## Run server 
run `php artisan serve`

### 1. Run docker compose

```
docker compose up --build
```

### 2. Run docker shell

```
docker compose exec -it app sh
```
```
php artisan migrate
```

### 3. Run Laravel App
```
https://localhost
or 
https://laravel.test/
```

### 4. Run PhpMyAdmin
```
http://localhost:8080/
```

### Start server
`php artisan serve`

### Migrate fresh seed
`php artisan migrate:fresh --seed`

### Seed 
`php artisan db:seed`

### Creating a model
`php artisan make:model`

### Creating a seeder
`php artisan make:seeder <name>Seeder`

### See all routes
`php artisan route:list --path=api`

### Example steps
`php artisan make:model`
- update migration and factories
`php artisan make:seeder ItemsSeeder`
`php artisan make:resource ItemResource`


## Docker up
run `composer install`
run `docker-compose build`
run `docker-compose up`

## Docker down Clear
run `docker-compose down -v --remove-orphans --rmi all`
