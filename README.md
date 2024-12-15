# Sofra - Laravel Backend Project

Sofra is a mobile application backend built using Laravel. It is designed to manage restaurants, clients, orders, and payments, allowing restaurants to handle food items, offers, and commissions, while clients can place orders and review restaurants. The admin panel provides comprehensive control over the platform.

## Database ERD

You can view the **Entity Relationship Diagram (ERD)** for the Sofra database by clicking the link below:

[View ERD](http://www.laravelsd.com/share/4fRk7W)

## Features

- **Client Authentication**: Clients can register, log in, and manage their profiles.
- **Restaurant Authentication**: Restaurants can register, log in, and manage their food items, offers, and orders.
- **Order Management**: Clients can place orders, and restaurants can manage and update order statuses.
- **Admin Panel**: The admin can manage users, restaurants, orders, roles, and more.
- **Role-based Permissions**: Different roles (Admin, Restaurant, Client) with tailored access controls using **Spatie Permission**.
- **Multi-Guard Authentication**: Uses **Sanctum API** for authentication and **Breeze** for web authentication.
- **Spatie Translatable**: Handles multi-language support with **Spatie Translatable** package for managing translated fields.
- **Spatie Media Library**: Handles media file uploads, such as images and documents, for various models.
- **Service-Repository Pattern**: Implemented **Service-Repository Pattern** to manage business logic and keep controllers lean.
- **Enums**: Utilizes **Enums** to manage constants in a clean and organized manner.
- **FCM Notifications**: **Firebase Cloud Messaging (FCM)** notifications for real-time updates.
- **Database Notifications**: Supports **database notifications** to notify users about changes.
- **Auto Check Permission Middleware**: Check **permissions** by adding routes column to permissions table in spatie package.

## Technologies

- **Laravel v11**
- **PHP v8.2**
- **MySQL**
- **Spatie Permission v6.10.1**
- **Spatie Media Library v11.10**
- **Sanctum v4.0**
- **Breeze v2.2.6**
- **Notification-channels/fcm v4.5**
- **Mailtrap for Mails**

## Table of Contents

- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Contributing](#contributing)
- [License](#license)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/YomnaAli26/sofra.git
    ```

2. Navigate to the project directory:

    ```bash
    cd sofra
    ```

3. Install the required dependencies using Composer:

    ```bash
    composer install
    ```

4. Install the frontend dependencies (if needed, for Admin panel or other UI features):

    ```bash
    npm install
    ```

## Environment Setup

1. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Set up your environment variables in `.env`. Configure the database, mailer, and other necessary services.

   Example for local database setup:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sofra
    DB_USERNAME=root
    DB_PASSWORD=
    ```

   Example for Firebase configuration (for FCM):

    ```ini
    FCM_SERVER_KEY=your-fcm-server-key
    ```

## Database Setup

1. Create the database:

    ```bash
    mysql -u root -p
    CREATE DATABASE sofra;
    ```

2. Run the migrations to set up the database tables:

    ```bash
    php artisan migrate
    ```

3. If needed, seed the database with initial data:

    ```bash
    php artisan db:seed
    ```

## Running the Application

1. To run the application locally, use the Laravel Artisan server:

    ```bash
    php artisan serve
    ```

2. You can access the application at `http://127.0.0.1:8000`.

## Contributing

We welcome contributions! Here's how you can contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and test them.
4. Submit a pull request with a clear description of your changes.

Please ensure that all new features are covered by tests.

## License

The Sofra project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
