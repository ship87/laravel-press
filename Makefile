PWD ?= pwd_unknown
PROJECT_NAME = $(shell echo  $(notdir $(PWD)) | sed -e s/[^[:alnum:]]//g )
DOCKER_COMPOSE_FILE = docker/$(if $(DOCKER_COMPOSE_FILE_NAME),$(DOCKER_COMPOSE_FILE_NAME),docker-compose-local.yml)

bash:
	docker exec -ti $(PROJECT_NAME)_app bash

ps:
	docker-compose -f $(DOCKER_COMPOSE_FILE) -p $(PROJECT_NAME) ps

init:
	sudo rm -R ./docker/data/mysql || true
	docker-compose -f $(DOCKER_COMPOSE_FILE) -p $(PROJECT_NAME) up -d --build --force-recreate
	docker exec $(PROJECT_NAME)_app cp .env.example .env
	docker exec $(PROJECT_NAME)_app composer install
	docker exec $(PROJECT_NAME)_app php artisan key:generate

migrate:
	docker exec -ti $(PROJECT_NAME)_app php artisan migrate

start:
	docker-compose -p $(PROJECT_NAME) up -d

stop:
	docker stop $(PROJECT_NAME)_mysql $(PROJECT_NAME)_nginx $(PROJECT_NAME)_app $(PROJECT_NAME)_redis

remove:
	docker stop $(PROJECT_NAME)_mysql $(PROJECT_NAME)_nginx $(PROJECT_NAME)_app $(PROJECT_NAME)_redis
	docker rm $(PROJECT_NAME)_mysql $(PROJECT_NAME)_nginx $(PROJECT_NAME)_app $(PROJECT_NAME)_redis
	docker rmi $(PROJECT_NAME)_mysql $(PROJECT_NAME)_app
	sudo rm -R ./docker/data/mysql

prune:
	docker system prune -af