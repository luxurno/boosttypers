### Created for BoostTypers
Project created for parsing watchthedeer website

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

## Static Code Analyse
###### Running PHPStan
vendor/bin/phpstan analyse src
