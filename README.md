
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

