# Laravel Todo Management System

A comprehensive Laravel-based Todo Management System with user authentication, role-based access control, and complete CRUD operations for todos with image and file attachments.

## Features

### User Panel
- ✅ User Registration & Login
- ✅ Email Verification
- ✅ Password Reset via Email
- ✅ Profile Management with Image Upload
- ✅ Todo CRUD Operations (Create, Read, Update, Delete)
- ✅ Todo Status Management (Pending/Completed)
- ✅ Image Upload for Todos
- ✅ File Attachment Upload (PDF, DOCX, ZIP, etc.)
- ✅ Dashboard with Statistics

### Admin Panel
- ✅ Complete Admin Dashboard
- ✅ User Management (View, Create, Activate/Deactivate, Delete)
- ✅ Todo Oversight (View all user todos)
- ✅ User Statistics and Analytics
- ✅ Profile Management

### Security & Authentication
- ✅ Laravel Breeze Authentication
- ✅ Email Verification System
- ✅ Password Reset Functionality
- ✅ Role-Based Access Control (Admin/User)
- ✅ Active/Inactive Account Management
- ✅ CSRF Protection
- ✅ File Upload Validation
- ✅ Middleware-based Security

### Technical Features
- ✅ Laravel 12 Framework
- ✅ MySQL Database
- ✅ Eloquent ORM
- ✅ Blade Templating Engine
- ✅ Bootstrap 5 UI
- ✅ File Storage System
- ✅ Responsive Design
- ✅ Clean Code Architecture

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd todo-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Configure your database and mail settings in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   MAIL_MAILER=smtp
   MAIL_HOST=your_smtp_host
   MAIL_PORT=587
   MAIL_USERNAME=your_email@domain.com
   MAIL_PASSWORD=your_email_password
   MAIL_ENCRYPTION=tls
   ```

5. **Database Setup**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Build Assets** (Optional)
   ```bash
   npm run build
   ```

8. **Start the Server**
   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000` in your browser.

## Default Admin Account

After seeding the database, you can login with:
- **Email:** `admin@example.com`
- **Password:** `password`

## Usage

### For Users:
1. Register a new account or login
2. Verify your email address
3. Access your dashboard to manage todos
4. Create, edit, and delete your todos
5. Upload images and attachments
6. Update your profile

### For Admins:
1. Login with admin credentials
2. Access admin dashboard for overview
3. Manage all users (activate/deactivate accounts)
4. View all todos across the system
5. Monitor system statistics

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── Auth/           # Authentication controllers
│   │   ├── User/           # User controllers
│   │   └── TodoController.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Todo.php
│   ├── Policies/
│   │   └── TodoPolicy.php
│   └── Http/Middleware/    # Custom middleware
├── database/
│   ├── factories/          # Model factories
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── resources/views/
│   ├── layouts/            # Blade layouts
│   ├── admin/              # Admin views
│   ├── auth/               # Authentication views
│   ├── user/               # User views
│   └── errors/             # Error pages
├── routes/
│   └── web.php             # Web routes
├── storage/app/public/     # File uploads
└── public/                 # Public assets
```

## Database Schema

### Users Table
- id, name, email, password
- role (admin/user), profile_image
- is_active, email_verified_at
- timestamps

### Todos Table
- id, user_id, title, description
- image, attachment, status (pending/completed)
- timestamps

## Security Features

- **Authentication:** Laravel Breeze with custom enhancements
- **Authorization:** Policies for todo management
- **Middleware:** Custom middleware for admin access and active user checks
- **File Validation:** Secure file upload with type and size validation
- **CSRF Protection:** Built-in Laravel CSRF protection
- **Password Hashing:** Bcrypt password hashing

## API Endpoints

### Public Routes
- `GET /` - Redirect to login
- `GET/POST /login` - User login
- `GET/POST /register` - User registration
- `GET/POST /forgot-password` - Password reset request
- `GET/POST /reset-password` - Password reset

### Authenticated Routes (Users)
- `GET /user/dashboard` - User dashboard
- `GET/POST /user/todos` - Todo management
- `GET/POST /user/profile` - Profile management

### Admin Routes
- `GET /admin/dashboard` - Admin dashboard
- `GET/POST /admin/users` - User management
- `GET /admin/todos` - Todo oversight

## Testing

Run the test suite:
```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For support, please contact the development team or create an issue in the repository.
