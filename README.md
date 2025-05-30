# 🎫 Sistema de Chamados (Tickets) - Laravel 12 + jQuery + Blade

Este projeto é um sistema de chamados (tickets) desenvolvido com **Laravel 12**, utilizando **princípios SOLID** e arquitetura limpa na API. O frontend é construído com **Blade** e **jQuery**, com consumo da API via AJAX.



## 🚀 Tecnologias Utilizadas

### Backend
- [Laravel 12](https://laravel.com/)
- PHP 8.2+
- MySQL ou PostgreSQL
- API RESTful
- Arquitetura com Service e DTOs
- Exceptions de domínio personalizadas

### Frontend
- Blade (Laravel Templates)
- jQuery (requisições AJAX)
- Bootstrap 5 (estilização)
- UBold Theme (template)

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
| GET    | /api/categories        | Listar todos as categorias    |
| GET    | /api/categories/{id}   | Ver detalhes de uma categoria |
| POST   | /api/categories        | Criar uma nova categoria      |
| PUT    | /api/categories/{id}   | Atualizar categoria           |
| DELETE | /api/categories/{id}   | Excluir categoria             |
---

## 💻 Exemplo de chamada AJAX

```js
$.ajax({
  url: '/api/tickets',
  method: 'POST',
  data: {
    title: 'Erro ao acessar sistema',
    description: 'Usuário não consegue acessar o painel.',
    category_id: 1
  },
  success: function(response) {
    console.log('Ticket criado!', response);
  },
  error: function(err) {
    console.error(err.responseJSON.message);
  }
});
```

---
## 📁 Estrutura de Código (parcial)

```
app/
├── DTOs/
│   └── Ticket/
│   └── Category/
├── Enums/
│   └── Ticket/
├── Exceptions/
│   └── Ticket/
├── Http/
│   ├── Controllers/
│   │   └── API/
│   └── Requests/
│       └── Ticket/
│       └── Category/
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
