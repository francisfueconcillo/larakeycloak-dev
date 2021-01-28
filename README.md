# LaraKeycloak Package Development

LaraKeycloak is an authorization implementation using [KeyCloak Socialite Provider](https://socialiteproviders.com/Keycloak/) (OpenIdConnect). It uses the Laravel's [Auth/Guard Interface](https://laravel.com/api/7.x/Illuminate/Contracts/Auth/Guard.html)

## Components:
- [Keycloak Server](https://www.keycloak.org) - I assume you already have this. If not checkout [KeyCloak in Docker](https://www.keycloak.org/getting-started/getting-started-docker)
- [Socialite Providers for KeyCloak](https://socialiteproviders.com/Keycloak/)

## Local Development Setup
1. Install [Docker Desktop](https://docs.docker.com/desktop/)
2. Clone this repository to your new empty project directory.
3. Create `.env` file from `.env.example`.
4. Run application services in Docker
```
$ docker-compose up -d
```
<!-- 5. Enable User Authentication pages with VueJS
```
docker-compose exec larakc php artisan ui vue --auth
``` -->
7. Install node dependencies
```
$ docker-compose exec larakc npm install
```
8. Compile Frontend JS and CSS. Keep this command running in a window so that JS will auto-compile with changes in vue files.
```
$ docker-compose exec larakc npm run watch
```
9. App should be running at `http://localhost:3000`

## Running commands 
To run commands inside the container:
```
$ docker-compose exec <app service-name> <command>
```
Where `<app service-name>` is the service name of the app defined in `docker-compose.yml`. In this project `larakc` is the app service name.

**IMPORTANT:** When running multiple projects, make sure their app service names are unique, including the service name for the database.

## Common Commands
- Installing a dependency by Composer
```
$ docker-compose exec larakc composer require <package-name>
```
- Applying new `.env` variables
```
docker-compose exec larakc php artisan config:clear
```
- Packages re-discovery
```
$ docker-compose exec larakc composer dump-autoload
```
- Restart the app service.
```
$ docker-compose restart larakc
```
- Stopping the all running services.
```
$ docker-compose stop
```

## Future Enhancements
- Use [Laravel Jetstream](https://github.com/laravel/jetstream)
