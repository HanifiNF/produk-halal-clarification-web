# produk-halal-kp Laravel Application

## Project Overview

This is a Laravel web application named "produk-halal-kp" (Halal Product - KP), built using Laravel 10.x framework. It's a halal product management system that includes user authentication and CRUD functionality for managing users. The application is built with PHP 8.1+ and uses modern development practices with Vite for asset bundling.

## Architecture & Technologies

- **Backend Framework**: Laravel 10.x
- **Frontend Build Tool**: Vite
- **Styling**: Bootstrap 5 with Sass
- **JavaScript**: ES6+ with Axios for HTTP requests
- **Database**: MySQL (default configuration)
- **Authentication**: Laravel's built-in authentication system
- **Package Manager**: Composer (PHP), NPM (JavaScript)

## Project Structure

```
app/                      # Main application code
├── Console/              # Artisan commands
├── Exceptions/           # Exception handling
├── Http/                 # Controllers, middleware
│   ├── Controllers/
│   └── Middleware/
├── Models/               # Eloquent models
└── Providers/            # Service providers
config/                   # Laravel configuration files
database/                 # Migrations, seeders, factories
├── migrations/
├── seeders/
└── factories/
public/                   # Public web assets
resources/                # Views, JS, SASS files
├── js/
├── sass/
└── views/
├── auth/                 # Authentication views
├── layouts/              # Layout templates
├── users/                # User management views
routes/                   # Application routes
├── web.php               # Web routes
├── api.php               # API routes
├── console.php           # Console routes
└── channels.php          # Broadcast channels
storage/                  # Compiled views, logs, cache
tests/                    # Unit and feature tests
```

## Key Features

- User authentication system (login, register, logout)
- User management with CRUD operations (protected by authentication)
- Bootstrap 5 responsive UI framework
- Modern asset compilation with Vite
- Laravel's Eloquent ORM for database interactions
- Database migrations and seeding

## Environment Configuration

The project uses .env files for configuration. The `.env.example` file includes:
- Database configuration (MySQL default)
- Cache and session settings
- Mail configuration (using Mailpit in development)
- Redis and queue settings
- AWS settings (for file storage)

## Building and Running

### Initial Setup:

1. Install PHP dependencies:
   ```bash
   composer install
   ```

2. Install Node.js dependencies:
   ```bash
   npm install
   ```

3. Create environment file and generate app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database settings in `.env`

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Seed the database (if needed):
   ```bash
   php artisan db:seed
   ```

### Development Commands:

- **Start development server**:
  ```bash
  php artisan serve
  ```

- **Run development assets**:
  ```bash
  npm run dev
  ```

- **Build assets for production**:
  ```bash
  npm run build
  ```

- **Run tests**:
  ```bash
  php artisan test
  # or
  ./vendor/bin/phpunit
  ```

### Common Artisan Commands:

- **Create migration**:
  ```bash
  php artisan make:migration create_table_name_table
  ```

- **Create controller**:
  ```bash
  php artisan make:controller ControllerName
  ```

- **Create model**:
  ```bash
  php artisan make:model ModelName
  ```

- **Clear caches**:
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  ```

## Routing

- **Web routes**: Defined in `routes/web.php`
- **API routes**: Defined in `routes/api.php`
- Main route: `/` displays the welcome page
- Authentication routes: `/login`, `/register`, `/home` (protected)
- User CRUD routes: `/users` (protected by auth middleware)

## Views & Frontend

- **Template Engine**: Blade
- **Main Layout**: `resources/views/layouts/app.blade.php`
- **Authentication Views**: `resources/views/auth/`
- **User Views**: `resources/views/users/`
- **Frontend Assets**: Processed by Vite with Sass preprocessing

## Development Conventions

- Laravel coding standards
- PSR-4 autoloading
- MVC architecture pattern
- Repository pattern (if implemented)
- Blade template syntax for views
- Eloquent ORM for database operations
- Vite for asset compilation
- Bootstrap for responsive styling

## Testing

- PHPUnit for unit and feature testing
- Laravel's testing tools
- Faker for generating test data
- Test files in `tests/` directory