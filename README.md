<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"
             width="400"
             alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg"
             alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework"
             alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework"
             alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework"
             alt="License">
    </a>
</p>

# Task Management System - Laravel 12

This project is a Laravel 12 based Task Management System developed using Blade and Bootstrap 5.

The application allows users to manage their personal tasks with authentication, task CRUD operations, file uploads, filtering, searching, and pagination.

A professional architecture approach is used including:

- Service Layer
- Policies
- Form Requests
- Enum
- AJAX File Upload
- Clean MVC Structure

---

# Features

## Authentication
- User Registration
- User Login
- Secure Authentication using Laravel Breeze

---

## Task Management
- Create Task
- Edit Task
- Delete Task
- Task Listing
- Task Status Management
- Due Date Support

---

## User-wise Tasks
- Each user can only access their own tasks
- Authorization handled using Laravel Policies

---

## File Uploads
- Multiple File Upload
- Image Preview
- PDF Preview
- AJAX Upload
- Uploaded File Listing

---

## Advanced Features
- Search Tasks
- Filter by Status
- Pagination
- Validation Handling
- Responsive Bootstrap UI

---

# Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL
- Bootstrap 5
- Blade Template Engine
- JavaScript Fetch API

---

# Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

---

# Installation

## 1) Clone Repository

```bash
git clone <repository-url>

cd task-manager

```

## 2) Install dependencies
```bash
composer install
```

## 3) Install Node Dependencies
```bash
npm install
```

## 4) Create environment file
```bash
cp .env.example .env
```

## 5) Generate application key
```bash
php artisan key:generate
```
## 5) Setup database
- Update your .env: (For loalhost)
```bash
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```
- Create DB manually: (in SQL)
```bash
CREATE DATABASE task_manager;
```

## 6) Run migrations
```bash
php artisan migrate
```

# Run Project

## 1) Terminal 1
```bash
php artisan serve
```

## 2) Terminal 2
```bash
npm run dev
```

## 3) Project URL
```bash
http://127.0.0.1:8000
```

# Quick Setup Commands

```bash
composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan storage:link

npm run build

php artisan serve
```