# User Management(Laravel 12)

##  Features

-  User authentication (login/logout)
-  View paginated user list
-  Create new users with detailed profile
-  Edit user & profile information
-  Delete users (Super Admin only)
-  Search users by name or username
-  Responsive UI using custom pure CSS

---
---

## Requirements

- PHP >= 8.2
- Composer
- MySQL or compatible DB
- Laravel 12
- Node.js & NPM (optional for frontend tooling)

---

## Installation

`bash
 Clone the repository
git clone https://github.com/yourusername/user-management-laravel.git

# Navigate into the project folder
cd user-management-laravel

# Install PHP dependencies
composer install

# Create a copy of .env
cp .env.example .env

# Generate app key
php artisan key:generate

# Configure your DB credentials in .env
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password

# Run migrations
php artisan migrate

# (Optional) Seed database
php artisan db:seed

# Run the development server
php artisan serve
