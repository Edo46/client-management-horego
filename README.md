
# Client Management Challenge

Please Follow this instruction to setup the project




## Installation

Install with Composer

```bash
  composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
  cp .env.example .env
```

Generate a new application key

```bash
  php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating

```bash
  php artisan migrate
```

Run Database Seed for default user

```bash
  php artisan db:seed
```

Start the local development server

```bash
  php artisan serve
```

## User Credential

Email : admin@mail.com
Passw : password123
