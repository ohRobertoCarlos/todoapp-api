# Instruções para rodar o projeto

## Denpendências para rodar projeto
 * docker
 * docker-compose-plugin

### Criar arquivo de configurações.
Crie um arquivo .env a partir do arquivo .env.example dentro do diretório todoapp-api/

#### Se estiver no linux apenas rode o seguinte comando:
 ```bash
     cp ./todoapp-api/.env.example ./todoapp-api/.env
```

### Dependendo da versão do seu docker, rode um dos comando abaixo na raiz do repositório:
```bash
    docker-compose up -d
```

ou

```bash
    docker compose up -d
```

### Em seguida, instale as dependencias:

```bash
    docker exec container-app ./composer install
```

### Rode as migrations e a aplicação estará sendo servida em http://localhost:8000:

```bash
    docker exec container-app php artisan migrate
```