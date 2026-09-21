# AulAquI API

API RESTful desenvolvida com Lumen para gerenciar informações de matérias, professores e aulas da plataforma [AulAquI](https://github.com/brnocesar/aulaqui).

## Descrição

Este projeto fornece uma API para cadastro e consulta de:
- Matérias
- Professores
- Aulas

A aplicação foi construída com PHP utilizando o framework Lumen, seguindo uma arquitetura simples e leve para APIs REST.

## Tecnologias

- PHP 7.2+
- Laravel Lumen 7
- SQLite (configuração padrão)
- Composer
- PHPUnit

## Estrutura do projeto

```bash
.
├── app
│   ├── Console
│   ├── Exceptions
│   ├── Http
│   │   └── Controllers
│   ├── Models
│   ├── Providers
│   └── User.php
├── bootstrap
├── database
│   ├── factories
│   ├── migrations
│   └── seeds
├── public
├── resources
├── routes
│   └── web.php
├── storage
├── tests
├── .editorconfig
├── .env.example
├── .gitignore
├── .styleci.yml
├── .test-requests.http
├── artisan
├── composer.json
├── composer.lock
├── phpunit.xml
├── README.md
└── server.php
```

## Requisitos

Antes de iniciar, verifique se você possui instalado:

- PHP 7.2+
- Composer
- SQLite (ou outro banco configurado no `.env`)

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/brnocesar/api-lumen-aulaqui.git
cd api-lumen-aulaqui
```

2. Instale as dependências:
```bash
composer install
```

3. Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

4. Gere a chave da aplicação:
```bash
php artisan key:generate
```

5. Configure o banco no arquivo `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

6. Execute as migrations e seeders:
```bash
php artisan migrate:fresh --seeder=MateriaTableSeeder
```

> O seeder atual implementa a criação das matérias iniciais, como Física, Matemática, Português, História, etc.

## Executando a aplicação

Para iniciar o servidor local:

```bash
php -S localhost:8080 -t public
```

A API estará disponível em:
```bash
http://localhost:8080
```

## Endpoints da API

A aplicação expõe os seguintes endpoints dentro do prefixo `/api`:

### Matérias

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/materias` | Lista todas as matérias |
| POST | `/api/materias` | Cria uma matéria |
| GET | `/api/materias/{id}` | Busca uma matéria por ID |
| PUT | `/api/materias/{id}` | Atualiza uma matéria |
| DELETE | `/api/materias/{id}` | Remove uma matéria |

### Professores

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/professores` | Lista todos os professores |
| POST | `/api/professores` | Cria um professor |
| GET | `/api/professores/{id}` | Busca um professor por ID |
| PUT | `/api/professores/{id}` | Atualiza um professor |
| DELETE | `/api/professores/{id}` | Remove um professor |

### Aulas

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/aulas` | Lista todas as aulas |
| POST | `/api/aulas` | Cria uma aula |
| GET | `/api/aulas/{id}` | Busca uma aula por ID |
| PUT | `/api/aulas/{id}` | Atualiza uma aula |
| DELETE | `/api/aulas/{id}` | Remove uma aula |

## Exemplos de requisições

### Criar matéria
```http
POST http://localhost:8080/api/materias
Content-Type: application/json

{
  "nome": "Física"
}
```

### Criar professor
```http
POST http://localhost:8080/api/professores
Content-Type: application/json

{
  "nome": "Professor João",
  "whatsapp": "11999999999",
  "short_bio": "Professor de matemática",
  "materias_id": [1, 2, 3]
}
```

### Criar aula
```http
POST http://localhost:8080/api/aulas
Content-Type: application/json

{
  "materia_id": 4,
  "professor_id": 2,
  "preco": "50",
  "inicio": "12:00",
  "fim": "15:00",
  "dia": 1
}
```

## Estrutura do banco

O projeto possui as seguintes tabelas principais:

- `materias`
- `professores`
- `aulas`

### `materias`
```php
Schema::create('materias', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
});
```

### `professores`
```php
Schema::create('professores', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->string('avatar')->nullable(true);
    $table->string('whatsapp');
    $table->string('short_bio');
    $table->string('full_bio')->nullable(true);
});
```

### `aulas`
```php
Schema::create('aulas', function (Blueprint $table) {
    $table->id();
    $table->bigInteger('materia_id')->unsigned();
    $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
    $table->bigInteger('professor_id')->unsigned();
    $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');
    $table->integer('preco')->unsigned();
    $table->time('inicio');
    $table->time('fim');
    $table->integer('dia')->unsigned();
});
```

## Seeders

O projeto já inclui um [seeder](https://www.digitalocean.com/community/tutorials/how-to-use-database-migrations-and-seeders-to-abstract-database-setup-in-laravel-pt) para popular a tabela de matérias:

```php
class MateriaTableSeeder extends Seeder
{
    static $materias = [
        "Física",
        "Matemática",
        "Robótica",
        "Programação",
        "Química",
        "Filosofia",
        "Artes",
        "Português",
        "Literatura",
        "História",
        "Geografia",
        "Sociologia",
    ];
}
```

## Observações

- O arquivo `.test-requests.http` contém exemplos de requisições para testar a API facilmente com o VS Code REST Client.
- Há endpoints comentados no arquivo de rotas para relacionamento entre matéria/professor/aula, que podem ser implementados futuramente.
- O projeto é uma API base para o sistema AulAquI e pode ser expandido com autenticação, filtros, paginação e regras de negócio adicionais.
