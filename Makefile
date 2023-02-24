test: up
	docker-compose exec php ./bin/phpunit

up:
	docker-compose up -d

init: up install-dependencies

install-dependencies: up
	docker-compose exec php sh -c "composer install"

down:
	docker-compose down