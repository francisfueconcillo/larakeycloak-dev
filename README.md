# Laravel Development with Docker

This is a scaffolding for developing Laravel applications with Docker

## Components:
- [Laravel 7](https://laravel.com/docs)
- [bitnami/bitnami-docker-laravel](https://github.com/bitnami/bitnami-docker-laravel)
- Pre-loaded [laravel-ui ^2.1](https://github.com/laravel/ui) with VueJS for User Login/Register pages


## Local Development Setup
1. Install [Docker Desktop](https://docs.docker.com/desktop/)
2. Clone this repository to your new empty project directory.
3. Create `.env` file from `.env.example`.
4. Modify `docker-compose.yml`'s `database` and `myapp` service names, as needed. Make sure they are unique, in case you are running multiple projects in Docker.
5. Run application services in Docker
```
$ docker-compose up -d
```
6. Enable User Authentication pages with VueJS
```
docker-compose exec myapp php artisan ui vue --auth
```
**NOTE** `myapp` service name depends on the changes made on Step 4.

7. Install node dependencies
```
$ docker-compose exec myapp npm install
```
8. Compile Frontend JS and CSS. Keep this command running in a window so that JS will auto-compile with changes in vue files.
```
$ docker-compose exec myapp npm run watch
```
9. App should be running at `http://localhost:3000`

## Running commands 
To run commands inside the container:
```
$ docker-compose exec <app service-name> <command>
```
Where `<app service-name>` is the service name of the app defined in `docker-compose.yml`. In this project `myapp` is the app service name.

**IMPORTANT:** When running multiple projects, make sure their app service names are unique, including the service name for the database.

## Common Commands
- Installing a dependency by Composer
```
$ docker-compose exec myapp composer require <package-name>
```
- Applying new `.env` variables
```
docker-compose exec myapp php artisan config:clear
```
- Packages re-discovery
```
$ docker-compose exec myapp composer dump-autoload
```
- Restart the app service.
```
$ docker-compose restart myapp
```
- Stopping the all running services.
```
$ docker-compose stop
```

## Future Enhancements
- Use [Laravel Jetstream](https://github.com/laravel/jetstream)
