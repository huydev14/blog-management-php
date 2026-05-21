# DevBlog CMS

A blog management system built with PHP MVC architecture, featuring an admin panel for managing posts, categories, users, and authentication flows.

![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue) ![License](https://img.shields.io/badge/license-MIT-green)
![Status](https://img.shields.io/badge/status-active-success)

## 📸 Screenshots

### Admin Panel

<table>
  <tr>
    <td width="50%">
      <img src=".github/images/dashboard.png" alt="Dashboard"/>
      <p align="center"><b>Dashboard</b></p>
    </td>
    <td width="50%">
      <img src=".github/images/posts.png" alt="Posts Management"/>
      <p align="center"><b>Posts Management</b></p>
    </td>
  </tr>
  <tr>
    <td width="50%">
      <img src=".github/images/users.png" alt="Users Management"/>
      <p align="center"><b>Users Management</b></p>
    </td>
    <td width="50%">
      <img src=".github/images/user-edit.png" alt="User Editing"/>
      <p align="center"><b>User Editing</b></p>
    </td>
  </tr>
</table>

### Client Pages

<table>
  <tr>
    <td width="50%">
      <img src=".github/images/home.png" alt="Homepage"/>
      <p align="center"><b>Homepage</b></p>
    </td>
    <td width="50%">
      <img src=".github/images/post-detail.png" alt="Post Detail"/>
      <p align="center"><b>Post Detail</b></p>
    </td>
  </tr>
</table>

## Features

### Authentication & Authorization

- Session-based authentication (login/logout)
- User registration with email verification
- Role-based access control (Admin, Editor, Author)

### Content Management

- **Posts**: Full CRUD operations with search, filter, and pagination
- **Categories**: Manage blog categories with post count tracking
- **Users**: User management with role and status control
- Form validation for all inputs
- Image upload support for user avatars and post thumbnails

### Security

- PDO prepared statements (SQL injection prevention)
- XSS and CSRF protection
- Bcrypt password hashing
- Secure file upload validation

### Centralized Error Logging

- Centralized application logging via `Core\\Logger`
- Controller actions are wrapped with centralized try/catch handling
- Runtime errors are written to `storage/logs/app.log`
- Mail, database, and unhandled request errors are logged in one place

## Tech Stack

**Backend:** PHP, MySQL, PDO, Composer (Dotenv, PHPMailer)  
**Frontend:** AdminLTE 4, Bootstrap, Font Awesome

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/huydev14/blog-management-php.git
cd blog
```

### 2. Install dependencies

```bash
composer install
```

### 3. Configure environment

Copy the example environment file and edit it:

```bash
# Copy .env.example to .env
cp .env.example .env
```

Update the following settings in `.env`:

```env
# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=blog
DB_USER=root
DB_PASS=

# Application URL
BASE_URL=http://localhost/blog
APP_BASE_PATH=/blog

# Mail Configuration (for email features)
MAIL_HOST=smtp.gmail.com
MAIL_USER=your-email@gmail.com
MAIL_PASS=your-app-password
```

**Gmail Setup (Optional):**

If you want to enable email features:

1. Enable 2-factor authentication on your Gmail account
2. Generate an App Password: https://myaccount.google.com/apppasswords
3. Use the generated 16-character password in `MAIL_PASS`

### 4. Setup database

Create and import database:

1. Create database named `blog`
2. Import SQL dump file `database/blog.sql`

### 5. Prepare writable storage

Make sure the logs directory is writable by your web server:

```bash
mkdir -p storage/logs
chmod -R 775 storage
```

### 6. Access the application

1. Make sure Apache is running in XAMPP/WAMP
2. Open your browser and navigate to: `http://localhost/blog/`
3. Login with the default admin account:

### Default Accounts

The system comes with pre-configured test accounts:

| Role   | Email              | Password | Description        |
| ------ | ------------------ | -------- | ------------------ |
| Admin  | admin@devblog.com  | 123456   | Full system access |
| Editor | editor@devblog.com | 123456   | Content management |
| Author | minhdev@gmail.com  | 123456   | Post creation      |

## Logging

- Main log file: `storage/logs/app.log`
- Typical logged events:
  - Controller runtime exceptions
  - Database connection errors
  - Mail send/configuration errors
  - Unhandled request exceptions

Quick check:

```bash
tail -f storage/logs/app.log
```

## 📁 Project Structure

```
blog/
├── database/           # SQL file testing dump
├── public/             # index.php, assets, .htaccess
├── routes/             # Route definition
├── src/
│   ├── app/
│   │   ├── Controllers/   # Admin & Client controllers
│   │   ├── Models/        # Database entities
│   │   ├── Views/         # Templates (layouts, emails)
│   │   ├── Middlewares/   # Authentication guard
│   │   └── Services/      # Mail Service, File Upload Service
│   ├── Core/              # Core files (Router, Controller, Model, View, Database, Logger)
│   ├── configs/           # Configuration file
│   └── helpers/           # Helper functions
├── storage/
│   └── logs/              # Centralized log files
├── vendor/                # Composer dependencies
├── .env                   # Environment config
```

## 🛠️ Development

### Debug Mode

Enable detailed error messages in `.env`:

```env
APP_DEBUG=true
```

Disable in production:

```env
APP_DEBUG=false
```

## 👤 Author

**Tran Gia Huy**

- GitHub: [@huydev14](https://github.com/huydev14)
- Email: huydev14@gmail.com
