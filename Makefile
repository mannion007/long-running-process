## Initialize the application
init: composer.phar
	php composer.phar install --no-interaction --optimize-autoloader --prefer-dist

## Installs composer locally
composer.phar:
	curl -sS https://getcomposer.org/installer | php

## Test the application
test: phpcs test-behat

## Run Behat tests
test-behat:
	vendor/bin/behat

## Run php code sniffer
phpcs:
	vendor/bin/phpcs --standard=PSR2 ./src

## Fix php syntax with code sniffer
phpcs-fix:
	vendor/bin/phpcbf --standard=PSR2 ./src