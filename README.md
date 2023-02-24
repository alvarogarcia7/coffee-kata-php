## PHP Boilerplate

### Running it for the first time

Instructions:

1. clone
2. `make init`
3. `make test`

### Configuring the tests in PHPStorm

* Create remote interpreter, backed by docker compose
* Set `docker-compose exec` to reuse the container
* As path mappings `<Project root> -> /app`
* As autoload: `/app/vendor/autoload.php`
* Run and debug tests should work.

