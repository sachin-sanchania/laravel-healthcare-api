<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Healthcare Appointment Booking API

This API allows users to book, view, and cancel healthcare appointments. It interacts with a MySQL database to store and retrieve data.

## Entities

1. **User**: Represents users of the system who can book appointments.
2. **Healthcare Professional**: Represents professionals available for appointments, each with a specialty.
3. **Appointment**: Represents booked appointments between users and healthcare professionals.

## Database Schema

The database schema includes tables for users, healthcare professionals, and appointments with appropriate relationships.

## Instructions

Follow these steps to set up and run the API on your local machine:

### 1. Clone the Repository

```
git clone https://github.com/sachin-sanchania/laravel-healthcare-api.git
cd healthcare-appointment-api
```


### 1. Set up Environment Variables & Run Composer Install

Copy the .env.example file to .env and configure the database connection and any other environment variables as needed:

```
cp .env.example .env
composer install
```

### 3. Install Dependencies

```
php artisan key:generate
```

### 4. Generate Application Key

```php artisan key:generate```

### 5. Run Migrations and Seeders

```php artisan migrate --seed```

### 6. Serve the Application

```php artisan serve```

## API Endpoints

### User Authentication

- **POST** `/register`: Register a new user.
- **POST** `/login`: Login with email and password to obtain an authentication token.

### Appointments

Authenticated routes (require token):
- **POST** `/appointment`: Book a new appointment.
- **POST** `/appointment/view`: View all appointments for a user.
- **POST** `/appointment/cancel`: Cancel a specific appointment.

### Healthcare Professionals

Authenticated route (require token):
- **POST** `/get-healthcare-professionals`: List all available healthcare professionals.

### Logout

Authenticated route (require token):
- **POST** `/logout`: Logout the user and invalidate the authentication token.

## Postman Collection

You can use the provided Postman collection to easily interact with the API endpoints. The collection file is located in the root directory of the project.

1. **Download the Postman Collection**:
    - Navigate to the root directory of the project.
    - Find the `Healthcare API.postman_collection.json` file.
    - Download this file to your local machine.

2. **Import the Collection into Postman**:
    - Open Postman.
    - Click on the "Import" button in the top-left corner.
    - Select the downloaded `Healthcare API.postman_collection.json` file.
    - The collection will be imported into Postman.

3. **Configure Environment Variables (Optional)**:
    - If needed, you can configure environment variables in Postman to easily switch between different environments (e.g., local, development, production).

4. **Start Making Requests**:
    - Now you can start making requests to the API endpoints using the imported collection in Postman.
    - Make sure to authenticate using the provided endpoints for registration and login to obtain an authentication token for accessing authenticated routes.

Feel free to explore and test the API using the provided Postman collection!
