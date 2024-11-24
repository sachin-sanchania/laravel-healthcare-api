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
cd laravel-healthcare-api
```


### 2. Set up Environment Variables & Run Composer Install

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
