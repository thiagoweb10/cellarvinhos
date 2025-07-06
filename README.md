# 🎫 Sistema de Chamados (Tickets) - Laravel 12
Este projeto é um sistema de chamados (tickets) desenvolvido com **Laravel 12**, utilizando **princípios SOLID** e arquitetura limpa na API.
<br><br>



## 🚀 Tecnologias Utilizadas

### Backend
- [Laravel 12](https://laravel.com/)
- PHP 8.2+
- MySQL ou PostgreSQL
- API RESTful
- Arquitetura com Service, DTOs, DRY e KISS
- Exceptions de domínio personalizadas


## ⚙️ Instalação e Configuração

### 1. Clone o repositório

```bash
git clone https://github.com/thiagoweb10/cellarvinhos.git
cd chamados
```

### 2. Instale as dependências PHP

```bash
composer install
```

### 3. Copie o `.env` e configure

```bash
cp .env.example .env
php artisan key:generate
```

Configure o acesso ao banco de dados no `.env`.

### 4. Rode as migrations

```bash
php artisan migrate
```

### 5. Inicie o servidor local

```bash
php artisan serve
```

---

## 🧾 Funcionalidades

- Abertura de chamados
- Edição e encerramento de tickets
- Filtros por status e categoria
- Validações robustas via DTOs
- Lançamento de exceções de domínio (ex: não é possível reabrir ticket fechado)

---

## 📡 Endpoints da API

| Método | Endpoint              | Descrição                     |
|--------|------------------------|-------------------------------|
| GET    | /api/tickets           | Listar todos os tickets       |
| GET    | /api/tickets/{id}      | Ver detalhes de um ticket     |
| POST   | /api/tickets           | Criar um novo ticket          |
| PUT    | /api/tickets/{id}      | Atualizar ticket              |
| DELETE | /api/tickets/{id}      | Excluir ticket                |
|        |                        |                               |
| GET    | /api/users             | Listar todos as users         |
| GET    | /api/users/{id}        | Ver detalhes de uma users     |
| POST   | /api/users             | Criar uma nova users          |
| PUT    | /api/users/{id}        | Atualizar users               |
| DELETE | /api/users/{id}        | Excluir users                 |
|        |                        |                               |
| GET    | /api/categories        | Listar todos as categorias    |
| GET    | /api/categories/{id}   | Ver detalhes de uma categoria |
| POST   | /api/categories        | Criar uma nova categoria      |
| PUT    | /api/categories/{id}   | Atualizar categoria           |
| DELETE | /api/categories/{id}   | Excluir categoria             |


---
## 📁 Estrutura de Código (parcial)

```
app/
├── DTOs/
│   └── Ticket/
│   └── Category/
├── Actions/
│   └── LoginUserAction.php
│   └── LogoutUserAction.php
├── Enums/
│   └── Ticket/
├── Exceptions/
│   └── Ticket/
│   └── Auth/
│   └── User/
├── Http/
│   ├── Controllers/
│   │   └── API/
│   └── Requests/
│       └── Ticket/
│       └── Category/
├── Trait/
│   └── ApiResponseTrait.php
├── Models/
│   └── Ticket.php
│   └── Category.php
├── Services/
│   └── TicketService.php
│   └── CategoryService.php
```

## 👨‍💻 Autor

Thiago Melo <br>
veja meu [LinkedIn](https://www.linkedin.com/in/thiago-melo-10/)
