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

## Product Table Details

### Migration
The product table was created with migration `2025_11_30_131915_create_products_table.php` and includes the following fields:

- `id`: Auto-incrementing primary key
- `umkm_id`: Foreign key referencing the `id` in the `users` table (cascading delete)
- `nama_produk`: String field for the product name
- `product_image`: Nullable string field for product image path
- `date`: Date field
- `verification_status`: Boolean field with default value of false
- `timestamps`: Created and updated timestamps

### Model
The `Product` model (`app/Models/Product.php`) includes:

- Fillable fields: `['umkm_id', 'nama_produk', 'product_image', 'date', 'verification_status']`
- Casts: `date` as date type and `verification_status` as boolean
- Relationship: A product belongs to a UMKM/user via `$this->belongsTo(\App\Models\User::class, 'umkm_id', 'id')`

### Relationship to User/UMKM
- In the User model, there's a one-to-many relationship where a user can have multiple products via `$this->hasMany(\App\Models\Product::class, 'umkm_id', 'id')`
- This connects products to UMKM users through the `umkm_id` foreign key
- The migration adds a foreign key constraint that will delete associated products when a UMKM/user is deleted (cascading delete)

### Admin Dashboard Integration
- The admin dashboard includes a section for "Halal Products" with a "Manage Products" link
- The dashboard view (`resources/views/admin/dashboard.blade.php`) has a placeholder for product management functionality

### Related UMKM Information
- UMKM (Usaha Mikro, Kecil, dan Menengah - Indonesian for micro, small, and medium enterprises) fields were added to the users table with migration `2025_10_21_054939_add_umkm_fields_to_users_table.php`
- These fields include: `nama_umkm` (UMKM name), `address`, `city`, `province`, and `establish_year`
- This allows UMKM users to have business information stored directly in the users table

## Blade Template Files Documentation

### Layout Files
1. **layouts/app.blade.php**: Main application layout with header, navigation, and page content area. Uses Tailwind CSS styling and includes the navigation component.

2. **layouts/navigation.blade.php**: Navigation bar with logo, dashboard link, user dropdown menu, and conditional admin dashboard link for users with admin privileges. Contains logout functionality and responsive mobile navigation.

3. **layouts/guest.blade.php**: Layout for unauthenticated users (likely exists but not read in this session).

### Main Pages
4. **welcome.blade.php**: Default welcome page for the application with links to Laravel documentation, Laracasts, and Laravel News. Contains the main landing page for unauthenticated users.

5. **dashboard.blade.php**: User dashboard showing a "You're logged in!" message. Now includes functionality to register new UMKMs with a modal form, buttons to manage existing UMKMs, and buttons to add and manage products. Displays a summary of the user's products. Contains JavaScript for modal interactions.

6. **home.blade.php**: (File content not read in this session but likely exists).

### Authentication Views
7. **auth/login.blade.php**: Login form.
8. **auth/register.blade.php**: Registration form.
9. **auth/confirm-password.blade.php**: Password confirmation form.
10. **auth/forgot-password.blade.php**: Password reset request form.
11. **auth/reset-password.blade.php**: Password reset form.
12. **auth/verify-email.blade.php**: Email verification page.
13. **auth/verify.blade.php**: Account verification page.
14. **auth/passwords/confirm.blade.php**: Password confirmation screen.
15. **auth/passwords/email.blade.php**: Password reset email form.
16. **auth/passwords/reset.blade.php**: Password reset form.

### Admin Views
17. **admin/dashboard.blade.php**: Admin dashboard with statistics cards for users, UMKMs, products, and reports. Contains links to manage users, UMKMs, and products. Only accessible to users with admin privileges.

### User Management Views
18. **users/index.blade.php**: Lists all users in a table with columns for ID, Name, Email, Phone Number, UMKM Name, City, Admin status, and Data Access. Includes pagination and actions for view, edit, and delete.

19. **users/create.blade.php**: Form to create a new user with fields for Name, Email, Phone Number, Password, UMKM information, and additional admin-only fields for Data Access, Pembina, and Status Pembina.

20. **users/edit.blade.php**: Form to edit an existing user with the same fields as the create form plus password confirmation.

21. **users/show.blade.php**: Displays detailed information about a specific user.

### UMKM Management Views
22. **umkm/index.blade.php**: Lists UMKMs registered by the current user. Includes a modal form to register new UMKMs with fields for UMKM Name, Email, Phone Number, Establishment Year, Address, City, and Province.

23. **umkm/show.blade.php**: Displays detailed information about a specific UMKM.

24. **umkm/edit.blade.php**: Form to edit an existing UMKM.

25. **umkm/listall.blade.php**: Lists all UMKMs for admin users (likely with additional management capabilities).

### Product Management Views
26. **products/index.blade.php**: Lists products registered by the current user in a table with columns for ID, Product Name, Date, Verification Status, and Actions. Includes pagination and actions for view, edit, and delete.

27. **products/create.blade.php**: Form to create a new product with fields for Product Name, Product Image (optional), Date, and Verification Status.

28. **products/show.blade.php**: Displays detailed information about a specific product including Product Name, Date, Verification Status, UMKM Name, and Product Image.

29. **products/edit.blade.php**: Form to edit an existing product with the same fields as the create form, with the ability to update the product image.

30. **products/admin-index.blade.php**: Lists all products from all users in a table with columns for ID, Product Name, UMKM Name, Date, Verification Status, and Actions. Includes pagination and actions for view, edit, and delete.

### Profile Views
31. **profile/edit.blade.php**: User profile management page with tabs for updating profile information, updating password, and deleting account.

32. **profile/partials/delete-user-form.blade.php**: Form to delete the user's account.

33. **profile/partials/update-password-form.blade.php**: Form to update the user's password.

34. **profile/partials/update-profile-information-form.blade.php**: Form to update the user's profile information.

### Component Views
35. **components/application-logo.blade.php**: Application logo component.
36. **components/auth-session-status.blade.php**: Component to display authentication session status.
37. **components/danger-button.blade.php**: Reusable danger button component.
38. **components/dropdown-link.blade.php**: Dropdown link component.
39. **components/dropdown.blade.php**: Dropdown component with trigger and content slots.
40. **components/input-error.blade.php**: Error message component for form inputs.
41. **components/input-label.blade.php**: Label component for form inputs.
42. **components/modal.blade.php**: Modal component with overlay and content.
43. **components/nav-link.blade.php**: Navigation link component with active state styling.
44. **components/primary-button.blade.php**: Primary button component.
45. **components/responsive-nav-link.blade.php**: Responsive navigation link component.
46. **components/secondary-button.blade.php**: Secondary button component.
47. **components/text-input.blade.php**: Text input component with styling.

## Product Management System

### Controllers
- **ProductController**: Handles all product-related operations including create, read, update, and delete functionality.
  - `index()`: Displays paginated list of products for the authenticated user with eager loading of UMKM relationship, ordered by creation date (most recent first)
  - `adminIndex()`: Displays paginated list of all products for admin users with eager loading of UMKM relationship
  - `create()`: Shows the form to create a new product
  - `store()`: Stores a new product in the database with verification_status automatically set to 0 (pending)
  - `show()`: Displays details of a specific product
  - `edit()`: Shows the form to edit an existing product
  - `update()`: Updates product information in the database - verification status can only be changed by admin users
  - `destroy()`: Deletes a specific product

### Models
- **Product model**: Defines the product entity with fillable fields (`umkm_id`, `nama_produk`, `product_image`, `date`, `verification_status`) and relationships to the User model.

### Database
- **Products table migration** (2025_11_30_131915_create_products_table.php): Creates the products table with the necessary fields and foreign key relationship to users table.

### Routes
- **Product routes**: Added resource routes for products in `routes/web.php` with auth middleware to protect all product operations.
- **Admin product routes**: Added `/admin/products` route accessible only to admin users to view all products.

### Additional Features
- **Storage link**: Created using `php artisan storage:link` to allow public access to uploaded product images.
- **Dashboard integration**: Added buttons and product summary to the user dashboard for easy access to product management features.
- **Role-based verification**: When users create products, the verification status is automatically set to pending (0). Only admin users can change the verification status through the edit form. Regular users can edit their products but cannot change the verification status.
- **UMKM name fallback**: When the `nama_umkm` field is not set, the system falls back to using the user's name, showing "N/A" if both are unavailable.

### User Interface Changes
- **Product creation**: The product creation form no longer includes an option to select verification status. All new products are automatically set to "pending" status.
- **Product editing**: Regular users see their current verification status displayed but cannot change it. Admin users can change the verification status using radio buttons.
- **Admin product management**: Added separate admin product view (`products.admin-index.blade.php`) that displays all products from all users, with a link from the admin dashboard.
- **Dashboard product display**: The user dashboard now includes a "My Products" section with columns for Product Name, UMKM Name, Date, Status, and Actions.
- **Product views**: Updated all product views (index, show, admin-index) to properly display the UMKM name with fallbacks.
