#!/bin/bash

echo Uploading Application container 
docker-compose up -d

echo Copying the configuration example file
docker exec -it seminovosbh-app cp .env.example .env

echo Install dependencies
docker exec -it seminovosbh-app composer install

echo Generate key
docker exec -it seminovosbh-app php artisan key:generate

echo Make migrations
docker exec -it seminovosbh-app php artisan migrate

echo Information of new containers
docker ps -a 