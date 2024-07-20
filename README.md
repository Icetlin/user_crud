# user_crud

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

авторизацию можно добавить по api key + headers