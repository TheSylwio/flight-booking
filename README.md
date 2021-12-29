# Flight Booking System

## Description

University project.

## Prerequisites

* PHP >= 8.0
* Composer
* Symfony CLI (used as local server)
* MySQL DB (I used XAMPP on Windows which includes MySQL)

## Instalation

1. Clone this repository
2. Install dependencies `composer install`
3. Create database `php bin/console doctrine:database:create`
4. Create database schema `php bin/console doctrine:schema:update --force`
5. Load dummy data (fixtures) `php bin/console doctrine:fixtures:load -n`
6. Run local server `symfony server:start`
7. API is available in `/api` route