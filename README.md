# Laravel API

## Requirements

- PHP >= 8.3
- Composer
- Node.js (if using Mix)
- Any other specific requirements

## Installation

Follow these steps to install the project:

### Clone the repository

```bash
git clone https://github.com/sagarpandey2709/laravelAPI.git
cd LaravelAPI
```

### Install dependencies

```bash
composer install
npm install
npm run dev  # If you are using Laravel Mix
```

### Setup environment

Copy the `.env.example` file to `.env` and modify it according to your environment.

```bash
cp .env.example .env
```

### Generate application key

```bash
php artisan key:generate
```

### Run migrations and seeders (if applicable)

```bash
php artisan migrate --seed
```

### Start the server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

