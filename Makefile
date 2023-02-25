test: up
	docker-compose exec ${DOCKER_OPTIONS} php ./bin/phpunit

test-ci: up
	DOCKER_OPTIONS="-T" $(MAKE) test

up:
	docker-compose up -d

init: up install-dependencies

bash: up
	docker-compose exec php bash

install-dependencies: up
	docker-compose exec php sh -c "composer install"

down:
	docker-compose down