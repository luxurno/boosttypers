### Created for BoostTypers (Team Leader Role)
Project created for parsing http://watchthedeer.com website

### Building container
docker-compose build 

### Running container
docker-compose up -d

### Stopping container
docker-compose down

### Running bash to container
docker-compose exec app_example bash

### Instalation for dependencies (inside container)
composer install

### Download Gallery Commands
###### Use following command to download elements
php bin/console app:download:element
###### Use following command to download photos for elements
php bin/console app:download:element-photos

#### Config file download location - (dedicated for now to watchthedeer.com)
config/packages/download.yml

## Database
###### To create DB use
php bin/console doctrine:database:create

###### To create tables use
php bin/console doctrine:schema:update --force

## Tests
###### Running API Tests in Codeception
vendor/bin/codecept run api

###### Running Unit Tests in Codeception
vendor/bin/codecept run unit

###### Running PHPSpec
vendor/bin/phpspec run

## Static Code Analyse
###### Running PHPStan
vendor/bin/phpstan analyse src

###
###### Disclaimer
Copyright 2021 © All rights reserved by Luxurno Marcin Szostak.
