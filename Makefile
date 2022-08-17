up:
	docker-compose up -d

bash:
	docker-compose exec server bash

stop:
	docker-compose stop

rm:
	docker-compose rm server --force
	docker-compose rm postgres --force
	docker-compose rm adminer --force

build:
	docker-compose up -d --build

rebuild: stop rm build
