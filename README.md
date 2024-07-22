# Laravel ViaCEP Project

This project is a Laravel API for querying multiple ZIP codes using the ViaCEP service.

## Requirements

- PHP 8.x
- Composer
- Laravel 8.x
- cURL (PHP extension)

## Setup

Follow the steps below to set up and run the project on your local machine.

### 1. Clone the Repository

1. `git clone git@github.com:leosfont/laravel-viacep.git`
2. `cd laravel-viacep`

### 2. Install Dependencies

1. `composer install`

### 3. Configure Environment Variables

1. Rename the `.env.example` file to `.env`:
   - `cp .env.example .env`
2. Configure the necessary environment variables in the `.env` file.

### 4. Generate Application Key

1. `php artisan key:generate`

### 5. Run the Server

1. Start the Laravel development server:
   - `php artisan serve`

The server will be running at `http://127.0.0.1:8000`.

## Testing

To run the automated tests:

1. `php artisan test`