setup:
	cp .env.dist .env && docker-compose build

start:
	docker compose up -d

bash:
	docker compose exec php bash