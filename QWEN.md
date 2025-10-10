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
- Admin dashboard accessible only to users with admin privileges
- Role-based access control with 'admin' and 'data_access' boolean fields

### User Roles and Permissions
- Regular users: Can log in and access standard user features
- Admin users: Can access admin dashboard and manage other users
- Data access users: Have special data access permissions as determined by the 'data_access' field

### Routing
- Web routes in `routes/web.php`
- API routes in `routes/api.php`
- Route model binding using Laravel's resource routes
- Admin-specific routes protected by custom 'admin' middleware

### Middleware
- Web middleware group for session, CSRF protection, etc.
- API middleware group with rate limiting
- Authentication middleware for protected routes
- Custom 'admin' middleware to protect admin-only routes and features

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

# Make a user an admin
php artisan make:admin user@example.com
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
- Custom middleware for admin access protection
- Only admin users can modify the data_access field for other users

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
- <!-- Import failed: popperjs/core - ENOENT: no such file or directory, access 'C:\laragon\www\produk-halal-kp\popperjs\core' --> (^2.11.6) for Bootstrap components
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
- `resources/views/layouts/app.blade.php` - Main layout with admin dashboard link in navbar

### Asset Files
- `resources/sass/app.scss` - Main SCSS file
- `resources/js/app.js` - Main JavaScript file
- `vite.config.js` - Vite build configuration

## Admin Dashboard Implementation

### Components Added
1. **AdminMiddleware** - Checks if authenticated user is an admin
2. **AdminDashboardController** - Handles admin dashboard display
3. **Admin Dashboard View** - Special dashboard for admin users
4. **Protected Route** - `/admin/dashboard` with 'admin' middleware
5. **Login Redirect Logic** - Admins redirected to dashboard after login
6. **Navbar Dropdown Link** - Visible only to admin users in the top navbar
7. **Data Access Management** - Admins can set 'data_access' for other users via radio buttons

### How Admin Dashboard Works
1. Admin user logs in using credentials (admin status assigned via seeder)
2. After authentication, system checks if user is an admin
3. If admin, redirects to `/admin/dashboard` instead of `/home`
4. Admins can access the dashboard through the dropdown menu in the navbar
5. Regular users cannot access the admin dashboard or see the link in the navbar

### Data Access Management
- Only admin users can see and modify the 'data_access' field for other users
- Implemented with radio buttons for "Yes" and "No" options in create/edit forms
- Uses proper validation to ensure the value is always updated (0 or 1)
- The 'admin' field cannot be modified through the UI - only through seeding or artisan commands