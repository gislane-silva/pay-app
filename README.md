30### Passo a passo
Clone Repositório
```sh
git clone https://github.com/gislane-silva/pay-app.git
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Preencher env ASAAS_TOKEN
```sh
ASAAS_TOKEN={sua_key}
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Gerar as tabelas
```sh
php artisan migrate
```


Acessar o projeto
[http://localhost:8989](http://localhost:8989)
