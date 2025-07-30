# Service Booking API

A comprehensive REST API for service booking management built with Laravel 11, featuring authentication, role-based access control, and complete CRUD operations for services and bookings.

## 🚀 Features

- **🔐 Authentication**: Token-based auth with Laravel Sanctum

## 📋 Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [API Endpoints](#api-endpoints)
- [Authentication](#authentication)
- [Testing](#testing)
- [API Documentation](#api-documentation)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)

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

### 2. Run Migrations and Seeders

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Or run both together
php artisan migrate:fresh --seed
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
| POST | `/api/login` | Login (admin/customer) |



**Built with ❤️ using Laravel**