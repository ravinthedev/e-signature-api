# Basic E-Signature API

![Laravel](https://img.shields.io/badge/Laravel-v11.x-red)
![Docker](https://img.shields.io/badge/Docker-20.10.10-blue)
![PHP](https://img.shields.io/badge/PHP-8.3-green)
![Swagger](https://img.shields.io/badge/Swagger-3.52-brightgreen)

## Table of Contents

- Introduction
- Objective
- Features
- Setup Instructions
  - Docker Setup
  - Running Unit Tests
- API Documentation
- License

## Introduction

This project is a basic E-Signature API built with Laravel. The primary goal is to allow users to electronically sign documents. While authentication and other basic Laravel functions are implemented, the core focus is on the e-signature functionality.

## Objective

Create a basic E-Signature API using Laravel that allows users to e-sign documents.

## Features

- User Registration and Authentication using Laravel Sanctum
- Document Upload (PDF format only)
- Signature Requests between Users
- Document Status Tracking (e.g., pending, signed)
- E-Signature Functionality
- Dockerized Environment
- Swagger API Documentation

## Requirements

## Setup Instructions

### Docker Setup

1. **Clone the repository:**

```
git clone https://github.com/ravinthedev/e-signature-api.git
cd e-signature-api
   ```

2. **Build and run the Docker containers:**

```
docker-compose up -d --build
   ```

3. **Install Composer dependencies:**

```
docker-compose exec app composer install
   ```

4. **Run migrations and seed the database:**

 ```
docker-compose exec app php artisan migrate --seed
   ```

5. **Generate application key:**

```
docker-compose exec app php artisan key:generate
   ```

6. **Access the application:**

   - The application will be accessible at [http://localhost]

### Running Unit Tests

1. **Switch to the application container:**

```
docker-compose exec app bash
   ```

2. **Run the tests:**

```
php artisan test
   ```

## API Documentation

### Generate Swagger Documentation


1. **Generate the Swagger documentation:**

 ```
docker-compose exec app php artisan l5-swagger:generate
   ```

2. **Access the Swagger UI:**

   The Swagger documentation will be available at [http://localhost/api/documentation](http://localhost/api/documentation).



## License

This project is licensed under the MIT License.
