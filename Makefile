build:
	docker compose build --build-arg GROUPID=$$(id -g) --build-arg USERID=$$(id -u)

up:
	docker compose up -d

down:
	docker compose down

bash:
	docker compose exec app bash