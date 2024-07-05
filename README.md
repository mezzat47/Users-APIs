
# User Management API

This project is a Laravel API to list, create, update, and delete users with OAuth2 authentication. The API also implements CORS and rate limiting.

## Requirements
    PHP >= 8.1
    Composer 2
    Laravel >= 10
    MySQL


## Installation

1- Install my-project with npm

```bash
  git clone https://github.com/your-username/Users-APIs.git

  cd Users-APIs
```
2- Install dependencies:

```bash
  composer install
```
3- Set up the environment:
```bash
  cp .env.example .env
  php artisan key:generate
```
4- Set up the database:
```bash
  php artisan migrate

```
5- Install Passport:
```bash
  php artisan passport::install
  php artisan passport::client

```
6- Link storage:
```bash
  php artisan storage:link

```
7- Run the Laravel development server:
```bash
  php artisan serve

```

## Postman Collection

A Postman collection for testing the APIs is provided in the repository. You can find it in the `Postman-Collection` directory. To use it:

1. Open Postman.
2. Click on `Import`.
3. Select the file from the `Postman-Collection` directory.
4. Start testing the APIs.

## Features

- List, create, update, show and delete users.
- OAuth2 authentication with Laravel Passport.
- CORS enabled.
- Rate limit of 20 requests per minute on all endpoints.

## Authentication

- Public method for viewing users.
- Protected methods for creating, updating, and deleting users (requires login).

## Rate Limiting

All endpoints are rate-limited to 20 requests per minute.
