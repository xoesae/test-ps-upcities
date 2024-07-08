# UpCities - Backend

## Passo a passo para a execução

- Tenha o docker instalado na máquina
- Caso o SO for windows, instale e configure o wsl2 junto com o docker
- Faça clone do projeto
- Entre na pasta do projeto
- Crie um arquivo `.env` com base no `.env.example` com o comando:
```
cp .env.example .env
```

- Instale as dependencias com o seguinte comando:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

- Rode o container com o comando:
```
./vendor/bin/sail up -d
```

- Gere uma nova chave
```
./vendor/bin/sail artisan key:generate
```

- Rode as migrações do banco de dados
```
./vendor/bin/sail artisan migrate:fresh --seed
```

- Instale as dependencias do frontend
```
./vendor/bin/sail npm install
```

- Suba o servidor vite para compilar as dependencias do frontend
```
./vendor/bin/sail npm run dev
```

- Acesse o projeto na url: `http://localhost:8000/pessoas`

## Testes
Para rodar os testes execute o comando: `./vendor/bin/sail artisan test`