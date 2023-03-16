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

## Time of the iterations

```
➜  coffee-machine-kata-php git:(master) f log --format="%ad %s" | grep -n iteration
1:Thu Mar 16 10:49:27 2023 +0400 Stop iteration 3
6:Thu Mar 16 10:36:38 2023 +0400 Start iteration 3
7:Thu Mar 16 10:36:32 2023 +0400 Stop iteration 2
13:Thu Mar 16 10:21:53 2023 +0400 Start iteration 2
14:Thu Mar 16 10:21:44 2023 +0400 Stop iteration 1
24:Thu Mar 16 09:50:51 2023 +0400 Start iteration 1
```

| iteration number | name               | expected time | actual time (min) | 
|------------------|:-------------------|---------------|-----------------|
| 1                | Making Drinks      | ~30 min       | 31              |
| 2                | Going into business | ~20 min       | 15              |
| 3                | Extra hot          | ~20  min      | 13              |
|total | - | ~70 min       | 59 min          |

I didn't complete the 4th and 5th iterations. That was not part of the goal.