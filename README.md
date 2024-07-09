# series-api
# CRUD de séries, temporadas e episódios utilizando injeção de dependências com Laravel

## Passos para executar o projeto
1. Caso esteja no Windows conecte com o WSL e depois entre em modo sudo

```sudo su```

2. Inicie o servico do docker

```service docker start```

3. Acessar a pasta do docker do projeto

```cd docker-laravel```

4. Verificar se seu docker está executando

```docker info```

5. Executar o docker-compose que criará os containers

```docker-compose up```

6. Criar o banco de dados com o nome "bduser" utilizando alguma ferramenta de interface gráfica (MySQL Workbench)

7. Acessar o container de PHP do docker

```docker-compose exec app bash```

8. Executar migrations (não existem seeders)

```php artisan migrate```

Observação: Se utilizando Windows com o WSL, todos os comandos do docker devem ser executados com sudo depois de conectar no WSL.

## Comandos úteis em caso de erro

1. Executar dentro da pasta docker em sudo. Este comando interrompe contêineres e remove contêineres, redes, volumes e imagens criados pelo up

```docker-compose down```

2. Parar todos os contêineres

```docker stop $(docker ps -q)```
