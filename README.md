### About Movies Collection

### How to run

Just copy and paste - for Docker with Compose V2:

```shell
cp .env.dist .env && docker compose build && docker compose up -d && docker compose exec php bash
```

and: 

```shell
bin/console demo:demo
```

or visit URLs:

http://localhost:8080/movies/random?limit=2

http://localhost:8080/movies/long-title

http://localhost:8080/movies/by-first-letter?letter=w