# PHP-Unit-Test Exercise

### 1. Start a container with `docker compose up -d`

-d = detached mode, containers run in background

-v deletes volumes after quitting a container (don't do that!)


### 2. Execute the Service you'd like to with `docker compose exec [name_of_service] bash`

In our case `[name_of_service]` is `app`
Opens a bash in your container


### 3. Run `composer install` to install all components from composer.json


### Other useful commands:

* Display all Containers with `docker compose ps -a`
* Quit the container with `exit`
* `docker compose down` Stops and removes a container
* `docker compose stop` Stops a container without deleting anything
* `docker compose start` Starts existing containers for a service
* `docker compose restart` Restarts all stopped and running services, or the specified services only



## Excecute a Unit Test

### Execute all Testcases with `vendor/bin/phpunit`

### Execute a specific Testcase with `vendor/bin/phpunit [./path_to_testfile/testfile_name.php]`

In our case `vendor/bin/phpunit ./tests/Unit/Service/CalcServiceTest.php`