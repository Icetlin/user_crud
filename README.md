# user_crud
скрины postman https://docs.google.com/document/d/1pcfFauzCsRksiUmG0XMA8T54Ckmc4k8kq40yEoy-6ns/edit?usp=sharing



запросы для тестов

create
curl -X POST http://localhost:9999/user \
-H "Content-Type: application/json" \
-d '{
"email": "example@example.com",
"name": "John Doe",
"age": 30,
"sex": "M",
"birthday": "1993-01-01",
"phone": "123-456-7890"
}'


get/read
curl -X GET http://localhost:9999/user/1


update
curl -X PUT http://localhost:9999/user/1 \
-H "Content-Type: application/json" \
-d '{
"email": "updated@example.com",
"name": "John Smith",
"age": 31,
"sex": "M",
"birthday": "1992-01-01",
"phone": "098-765-4321"
}'

delete
curl -X DELETE http://localhost:9999/user/1





Как развернуть у себя?

1 копируем репозиторий
2 выполняем docker-compose up -в в корне проекта
3 заходим в fpm контейнер - выполняем миграции php bin/console doctrine:migrations:migrate
4 можно пользоваться апи


авторизацию можно добавить по api key + headers