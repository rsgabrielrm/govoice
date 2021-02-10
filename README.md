# GoVoice

The govoice system is designed for testing and study purposes, where you can create multiple users, customers, numbers and number preferences.

The project was developed with laravel framework and docker, if you are going to use the docker in your local environment for testing, follow the steps: (Have docker and docker compose installed)

### 1) Environment setting
After cloning the project, enter the folder through the terminal and make a copy of the .env.example file, renaming the copy to .env

```bash
cp .env.example .env
```
### 2) To initialize the containers, run the following command

```bash
docker-compose up -d
```
### 3) After finishing the initialization, list the containers with the command

```bash
docker ps
```

### 4) Look for the name of the container that has the image “sail-8.0/app”

![N|Solid](https://i.imgur.com/ZVFB2bt.png)

### 5) Enter the container with the command

```bash
docker exec -it <container name> bash
```
In our example

```bash
docker exec -it govoice_laravel.test_1 bash
```
### 6) If everything is fine so far, you will see something like the image below

![N|Solid](https://i.imgur.com/ixfC8WE.png)

### 7) Install composer dependencies

```bash
composer install
```

### 8) Install npm dependencies

```bash
npm install
```

### 9) Generate a key

```bash
php artisan key:generate
```

### 10) Run migrations

```bash
php artisan migrate
```

### 11) Compile css and javascript

```bash
npm run prod
```

### 12) Open your browser and go to localhost
![N|Solid](https://i.imgur.com/TYOPg2X.png)

## Optional commands
### To seed data in the database, run the command

```bash
php artisan db:seed
```

### To run automated tests, run the command

```bash
vendor/bin/phpunit
```

