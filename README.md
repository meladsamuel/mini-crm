# Mini-CRM


Mini-CRM is a Laravel-based web application that allows you to manage companies and their employees, acting as a basic CRM system.


## Requirements

- PHP 8.x or higher
- Laravel 10.x
- Mailgun account (for email notification feature)


## Features

- Basic Laravel authentication system for administrators
- Database seeding to create the first administrator account
- CRUD functionality for managing companies and employees
- Companies have the following fields: name (required), email, logo (minimum 100x100), and website
- Employees have the following fields: first name (required), last name (required), email, phone, and company (foreign key to companies)
- Companies' logos are stored in the storage/app/public directory and are accessible to the public
- Pagination of companies and employees list (10 entries per page)
- Validation of form inputs using Laravel's validation functions
- Unit tests for the models, controllers, and routes
- Authentication middleware for protecting routes


## Installation


To install Mini-CRM, follow these steps:

- Clone the repository: `git clone https://github.com/your_username/mini-crm.git`
- Install the required dependencies: `composer install`
- Copy the example .env file and set up the database configuration: `cp .env.example .env`
- Generate the application key: `php artisan key:generate`
- Migrate the database: `php artisan migrate`
- Seed the database: `php artisan db:seed --class=UserSeeder`
- Link the storage directory: `php artisan storage:link`
- Start the development server: `php artisan serve`


## Usage
To use Mini-CRM, navigate to http://localhost:8000 in your web browser. You will be presented with a login screen. Use the administrator email (admin@admin.com) and password (password) to log in.
Once you are logged in, you can manage companies and their employees. To add a new company or employee, click on the "Create" button on the respective index page. To edit or delete an existing company or employee, click on the corresponding link in the table.


## Email Notification
This application also sends an email notification whenever a new company is added. You need to set up Mailgun account and configure .env file accordingly. The email will be sent to the email address specified in the MAIL_FROM_ADDRESS configuration variable.

