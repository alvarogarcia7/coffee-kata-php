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
1:Sat Feb 25 20:33:37 2023 +0400 Finish iteration 5
8:Sat Feb 25 20:17:23 2023 +0400 Start iteration 5
9:Sat Feb 25 20:12:32 2023 +0400 Finish iteration 4
18:Sat Feb 25 19:52:28 2023 +0400 Start iteration 4
19:Sat Feb 25 19:50:59 2023 +0400 Finish iteration 3
30:Sat Feb 25 19:34:10 2023 +0400 Restart iteration 3
31:Fri Feb 24 22:23:39 2023 +0400 Finish iteration 3
45:Fri Feb 24 21:54:41 2023 +0400 Start iteration 3
46:Fri Feb 24 21:54:33 2023 +0400 Finish iteration 2
59:Fri Feb 24 21:34:39 2023 +0400 Start iteration 2
60:Fri Feb 24 21:31:32 2023 +0400 Finish iteration 1
XX:Fri Feb 24 21:05:28 2023 +0400  Red: make tea with 1 sugar (Start of the first iteration)
```

| iteration number | name               | expected time | actual time       | 
|------------------|:-------------------|---------|-------------------|
| 1                | Making Drinks      | ~30 min | 00:16:14          |
| 2                | Going into business | ~20 min | 00:20:04          |
| 3                | Extra hot          | ~20  min | 00:45:47          |
| 4                | Making money       | ~20  min | 00:19:54          |
| 5                | Running out        | ~20  min | 00:26:04          |
|total | - | ~110 min | 2:07:59 (128 min) |
