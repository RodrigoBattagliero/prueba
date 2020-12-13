docker-compose stop
docker-compose build
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php php bin/console --no-interaction doctrine:migration:migrate