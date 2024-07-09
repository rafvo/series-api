# series-api
# CRUD of series, seasons and episodes using dependency injection with Laravel

## Steps to execute the project
1. If you are on Windows, connect to WSL and then enter sudo mode

```sudo su```

2. Start the docker service

```service docker start```

3. Access the project's docker folder

```cd docker-laravel```

4. Check if your docker is running

```docker info```

5. Run docker-compose which will create the containers

```docker-compose up```

6. Create the database with the name "bduser" using a graphical interface tool (MySQL Workbench)

7. Access the docker PHP container

```docker-compose exec app bash```

8. Run migrations

```php artisan migrate```

Note: If using Windows with WSL, all docker commands must be run with sudo after connecting to WSL.

## Useful commands in case of error

1. Run inside the docker folder under sudo. This command stops containers and removes containers, networks, volumes, and images created by up

```docker-compose down```

2. Stop all containers

```docker stop $(docker ps -q)```
