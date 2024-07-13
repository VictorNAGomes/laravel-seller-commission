# Laravel - Seller commission

### Passo a passo para a instalação

Clone o Repositório

```sh
git clone https://github.com/VictorNAGomes/laravel-seller-commission.git
```

```sh
cd laravel-seller-comission
```

Suba os containers do projeto

```sh
docker-compose up -d
```

Crie o Arquivo .env

```sh
cp .env.example .env
```

Acesse o container app

```sh
docker-compose exec app bash
```

Instale as dependências do projeto

```sh
composer install
```

Gere a key do projeto Laravel

```sh
php artisan key:generate
```

Rodar as migrations

```sh
php artisan migrate
```

Rodar as seeds

```sh
php artisan db:seed
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)

---

# Documentação da API

## Endpoints

### Vendedor

#### POST /seller

Cria um novo vendedor.

**Request:**

-   Headers:
    -   Content-Type: application/json
-   Body:
    ```json
    {
        "name": "string",
        "email": "string"
    }
    ```

**Response:**

-   201 Created
    -   Body:
    ```json
    {
        "status": true,
        "message": "Vendedor Criado com sucesso"
    }
    ```
-   400 Bad Request

#### GET /seller

Retorna todos os vendedores.

**Response:**

-   200 OK
    -   Body:
    ```json
    [
        {
            "id": "integer",
            "name": "string",
            "email": "string",
            "created_at": "timestamp",
            "updated_at": "timestamp"
        }
    ]
    ```

#### GET /seller/{id}

Retorna um vendedor específico pelo ID.

**Parametros:**

-   Path:
    -   id (integer): ID do vendedor

**Response:**

-   200 OK
    -   Body:
    ```json
    {
        "id": "integer",
        "name": "string",
        "email": "string",
        "created_at": "timestamp",
        "updated_at": "timestamp"
    }
    ```
-   404 Not Found

#### PATCH /seller/{id}

Atualiza um vendedor específico pelo ID.

**Parametros:**

-   Path:
    -   id (integer): ID do vendedor

**Request:**

-   Headers:
    -   Content-Type: application/json
-   Body (contém os campos a serem atualizados):
    ```json
    {
        "name": "string",
        "email": "string"
    }
    ```

**Response:**

-   200 OK
    -   Body:
    ```json
    {
        "status": true,
        "message": "Vendedor Editado com sucesso"
    }
    ```
-   400 Bad Request
-   404 Not Found

#### DELETE /seller/{id}

Deleta um vendedor específico pelo ID.

**Parametros:**

-   Path:
    -   id (integer): ID do vendedor

**Response:**

-   200 OK

    -   Body:

    ```json
    {
        "status": true,
        "message": "Vendedor deletado com sucesso"
    }
    ```

-   404 Not Found

#### GET /seller/{id}/sales

Retorna todas as vendas de um vendedor específico.

**Parameters:**

-   Path:
    -   id (integer): ID do vendedor

**Response:**

-   200 OK
    -   Body:
    ```json
    [
        {
            "id": "integer",
            "seller_id": "integer",
            "amount": "number",
            "created_at": "timestamp",
            "updated_at": "timestamp"
        }
    ]
    ```
-   404 Not Found

---

### Vendas

#### POST /sales

Cria uma nova venda.

**Request:**

-   Headers:
    -   Content-Type: application/json
-   Body:
    ```json
    {
        "id_seller": "integer",
        "value": "number"
    }
    ```

**Response:**

-   201 Created
    -   Body:
    ```json
    {
        "status": true,
        "message": "Venda cadastrada com sucesso"
    }
    ```
-   400 Bad Request
-   404 Not Found
