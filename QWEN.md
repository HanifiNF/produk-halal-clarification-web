# QWEN.md - Produk Halal KP Project Context

## Project Overview

This is a Laravel web application framework project named "produk-halal-kp", which appears to be designed for managing halal product information. It's built on Laravel 10.x with PHP 8.1+ and follows the Model-View-Controller (MVC) architectural pattern.

The application includes user management functionality with full CRUD operations for users, authentication system, and is configured to work with a MySQL database as the default.

## Project Structure

```
├── app/                    # Main application code
│   ├── Console/           # Artisan console commands
│   ├── Exceptions/        # Exception handling
│   ├── Http/              # HTTP layer (controllers, middleware)
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── bootstrap/             # Framework bootstrapping
├── config/                # Configuration files
├── database/              # Migrations, seeds, factories
├── public/                # Public assets and entry point
├── resources/             # Views, CSS, JS assets
├── routes/                # Application routes
├── storage/               # Compiled templates, logs, cache
├── tests/                 # Automated tests
├── artisan               # CLI interface
├── composer.json         # PHP dependencies
├── package.json          # Node.js dependencies
├── .env                  # Environment configuration
└── ...
```

## Key Configuration

- **Framework**: Laravel 10.x
- **PHP Version**: ^8.1
- **Database**: MySQL (default)
- **Frontend Build**: Vite with Bootstrap and Sass
- **Authentication**: Laravel Sanctum for API tokens
- **Testing**: PHPUnit

## Application Features

### User Management
- Full CRUD operations for users (create, read, update, delete)
- User authentication system
- Password hashing using Laravel's built-in hashing
- Form validation for user data

### Routing
- Web routes in `routes/web.php`
- API routes in `routes/api.php`
- Route model binding using Laravel's resource routes

### Middleware
- Web middleware group for session, CSRF protection, etc.
- API middleware group with rate limiting
- Authentication middleware for protected routes

## Building and Running

### Initial Setup
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

# Run database migrations
php artisan migrate

# Seed database (if needed)
php artisan db:seed
```

### Development Commands
```bash
# Serve application locally
php artisan serve

# Build frontend assets for development
npm run dev

# Build frontend assets for production
npm run build

# Run tests
php artisan test
# or
./vendor/bin/phpunit

# Run specific migration
php artisan migrate

# Rollback migrations
php artisan migrate:rollback
```

### Common Artisan Commands
```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Run database migrations
php artisan migrate

# Create a new migration
php artisan make:migration create_table_name_table

# Create a new model
php artisan make:model ModelName

# Create a new controller
php artisan make:controller ControllerName
```

## Development Conventions

### Coding Standards
- Follows PSR-4 autoloading standards
- Laravel coding conventions
- Uses Pint (Laravel's coding style fixer) as development dependency

### Architecture Patterns
- MVC architecture
- Repository pattern encouraged
- Service providers for application bootstrapping
- Resource controllers for CRUD operations

### Security
- Passwords are hashed using Laravel's hashing
- CSRF protection enabled by default
- SQL injection prevention through Eloquent ORM
- Input validation using Form Request classes

## Key Dependencies

### PHP Dependencies
- Laravel Framework (^10.10)
- Laravel Sanctum (^3.3) for API authentication
- Laravel Tinker (^2.8) for REPL
- Guzzle HTTP client (^7.2)

### Frontend Dependencies
- Vite (>=6.0.0) for asset building
- Bootstrap (^5.2.3) for CSS framework
- Axios (^1.6.4) for HTTP requests
- @popperjs/core (^2.11.6) for Bootstrap components
- Sass (^1.56.1) for CSS preprocessing

## File Locations

### Important Files
- `routes/web.php` - Main web routes
- `routes/api.php` - API routes
- `app/Http/Kernel.php` - Middleware configuration
- `app/Providers/RouteServiceProvider.php` - Route configuration
- `config/database.php` - Database configuration
- `config/app.php` - Main application configuration

### Views
- `resources/views/` - Blade templates
- `resources/views/users/` - User management views
- `resources/views/welcome.blade.php` - Default welcome page

### Asset Files
- `resources/sass/app.scss` - Main SCSS file
- `resources/js/app.js` - Main JavaScript file
- `vite.config.js` - Vite build configuration