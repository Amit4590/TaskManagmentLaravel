<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

# Ride Booking Laravel Assessment

This project is a Laravel-based backend application that provides APIs for a simple ride-booking flow used by a mobile app.

A minimal admin panel is also included using Laravel Blade templates to view rides and ride details.

---

## Features

### Swagger Documentation
- Swagger UI implemented using **L5 Swagger**
- All Controllers include `@OA\...` annotations

---

## Requirements

- PHP 8.1+
- Composer
- MySQL
- Laravel 10/11

---

## Installation

### 1) Clone the repository
```bash
git clone <your-repository-url>
cd ride-booking
```

### 2) Install dependencies
```bash
composer install
```

### 3) Create environment file
```bash
cp .env.example .env
```

### 4) Generate application key
```bash
php artisan key:generate
```

### 5) Setup database
- Update your .env: (For loalhost)
```bash
DB_DATABASE=ride_booking
DB_USERNAME=root
DB_PASSWORD=
```
- Create DB manually: (in SQL)
```bash
CREATE DATABASE ride_booking;
```

### 6) Run migrations
```bash
php artisan migrate
```

### 7) Seed dummy data
```bash
php artisan db:seed
```
- Seeders create:
	- 2 Passengers
	- 2 Drivers

### 8) Generate Swagger docs
```bash
php artisan l5-swagger:generate
```

### 9) Run the server
```bash
php artisan serve
```

---

### Swagger Documentation
After running the project, open this URL to test the api:
```bash
http://127.0.0.1:8000/api/documentation
```

---

### Admin Panel
Admin rides list:
```bash
http://127.0.0.1:8000/admin/rides
```

---

## API Endpoints

### Passenger APIs

#### Create Ride Request
#### POST
```bash
/api/passenger/rides
```
Body:

```bash 
{
  "passenger_id": 1,
  "pickup_lat": 26.8467,
  "pickup_lng": 80.9462,
  "destination_lat": 26.9124,
  "destination_lng": 75.7873
}
```

---

#### Approve Driver
#### POST
```bash
/api/passenger/rides/{ride}/approve-driver
```
Body:

```bash 
{
  "passenger_id": 1,
  "driver_id": 1
}
```

---

#### Passenger Complete Ride
#### POST
```bash
/api/passenger/rides/{ride}/complete
```
Body:

```bash 
{
  "passenger_id": 1
}
```

---

### Driver APIs


#### Update Driver Location
#### POST
```bash
/api/driver/location
```
Body:

```bash 
{
  "driver_id": 1,
  "lat": 26.8467,
  "lng": 80.9462
}
```

---

#### Get Nearby Pending Rides
#### GET
```bash
/api/driver/rides/nearby?driver_id=1&radius_km=10
```

---

#### Request / Claim Ride
#### POST
```bash
/api/driver/rides/{ride}/request
```
Body:

```bash 
{
  "driver_id": 1
}
```

---

#### Driver Complete Ride
#### POST
```bash
/api/driver/rides/{ride}/complete
```
Body:

```bash 
{
  "driver_id": 1
}
```

--- 

### API Response Format

#### Success

```bash
{
  "success": true,
  "message": "Success",
  "data": {}
}
```

#### Error (Validation)
```bash
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "field": [
      "The field field is required."
    ]
  }
}
```

---

### Database Tables
- passengers
- drivers
- driver_locations
- rides
- ride_driver_requests

--- 

### Run All Commands (Quick Setup)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan l5-swagger:generate
php artisan serve
```

--- 

### Notes
- Authentication is not implemented as per requirement
- Passenger actions are restricted by passenger_id
- Driver actions are restricted by driver_id
- Ride completion requires both passenger + driver completion