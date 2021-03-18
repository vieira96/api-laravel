# API do teste em Laravel

## composer update para instalar as dependencias do projeto

### alterar o arquivo .env para as suas informações, (nome do banco, usuario, password)

### php artisan migrate para executar as migrações necessárias para o projeto.

## endpoints

POST suabase/api/create create user
PUT suabase/api/update/id update user
DELETE suabase/api/delete/id delete user
GET suabase/api/user/id read user

GET suabase/api/states pega todos os estados
GET suabase/api/states/id pega um unico estado

GET suabase/api/cities pega todas as cidades
GET suabase/api/cities/id pega uma unica cidade

GET suabase/api/adresses pega todos os endereços
GET suabase/api/adresses/id pega um unico endereço

GET suabase/api/users-per-city pega os usuários por cidade
GET suabase/api/users-per-state pega os usuários por estado