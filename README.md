# Service Booking API

A comprehensive REST API for service booking management built with Laravel 12, featuring authentication, role-based access control, and complete CRUD operations for services and bookings.

In Below the Installation Process, Routes, Tast Cases, and Documentaion are provided.

## 🚀 Features

- **🔐 Authentication**: Token-based auth with Laravel Sanctum

## 🔧 Requirements

- PHP 8.2
- Composer
- MySQL 8.0+
- Laravel 12.x

## 📦 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/kamrulhsan/service-booking-api.git
cd service-booking-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

### 4. Configure Environment Variables

Edit `.env` file with your database and application settings:

```env
APP_NAME="Service Booking API"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=service_booking
DB_USERNAME=root
DB_PASSWORD=your_password

```

## 🗄️ Database Setup

### 1. Create Database

# For MySQL
```
mysql -u root -p
CREATE DATABASE service_booking;
exit
```

### 2. Run Migrations and Seeders

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Or run both together
php artisan migrate:fresh --seed
```

### Start Development Server

```bash
php artisan serve
```

### 3. Test Credentials

After seeding, you can use these credentials:

**Admin User:**
- Email: `admin@example.com`
- Password: `123456`

**Customer User:**
- Email: `user1@example.com`
- Password: `123456`

## 🌐 API Endpoints

### Public Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Register new customer |
| POST | `/api/login` | Login (customer) |
| POST | `/api/admin-login` | Login (admin) |

### Authenticated Endpoints (Customer)

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/logout` | Logout current user |
| GET | `/api/services` | View all active services |
| GET | `/api/bookings/user` | View own bookings |
| POST | `/api/bookings` | Create new booking |
| GET | `/api/bookings/{id}` | View specific booking |

### Admin Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/admin/bookings` | Get All Booking |
| Delete | `/api/bookings/{booking}` | Delete booking |

| GET | `/api/services/{id}` | Show perticular services |
| POST | `/api/services` | Create new service |
| PUT | `/api/services/{id}` | Update service |
| DELETE | `/api/services/{id}` | Delete service |

## 🔐 Authentication

This API uses Laravel Sanctum for token-based authentication.

### Login Flow

1. **Register/Login** to get access token
2. **Include token** in subsequent requests
3. **Use Bearer token** in Authorization header

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test class
php artisan test tests/Unit/AuthTest.php
php artisan test tests/Unit/ServiceTest.php
php artisan test tests/Unit/BookingTest.php
```

### Test Coverage

- ✅ Authentication (register, login, logout)
- ✅ Service management (CRUD operations)
- ✅ Booking system (CRUD operations)


The API will be available at `http://localhost:8000/api`
The API Documentation will be available at `http://localhost:8000/api/documentation`

**Built with ❤️ using Laravel 12**