# About this project

A Customer Relationship Management (CRM) app with multiple roles using Laravel 10, Breeze(for authentication) and Spatie(to manage user permissions and roles).

## Installation
1. To run this project on your machine, fork it first.
2. Go to the folder application using cd command on your cmd or terminal
3. Run "composer install" on your cmd or terminal
4. Rename .env.example to .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
5. Run "php artisan key:generate"
6. Run "php artisan migrate --seed" (it has some seeded data for testing)
7. Run "npm install"
8. Run "npm run dev"
9. Open new terminal and run "php artisan storage:link"
10. Run "php artisan serve"
11. Go to the server link localhost:8000 OR 127.0.0.1:8000

## Features
 - Dashboard
 - User management
 - Deal management
 - Customer management
 - Contact database management
 - Item management
 - Deals Management
 - Documents upload and download
 - Assign and manage tasks
 - Secure registration & login
 - Roles & Permissions thanks to Spatie (https://github.com/spatie/laravel-permission)

## Initial roles and permissions:
 - superadmin (all)
 - user (Manage contacts, deals, documents, tasks)

## Superadmin credentials
 - email: admin@admin.com
 - password: admin123
