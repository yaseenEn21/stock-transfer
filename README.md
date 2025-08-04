# Stock Transfer Management System

This project is a system for managing stock transfers between warehouses, built using **Laravel 12** and **MySQL**.

---

## Concepts and Technologies Used

### 1. Service Layer
- The service layer separates business logic from controllers.
- For example, the `StockTransferService` handles changing the transfer status with permission checks.
- This improves code organization, testability, and reusability.

### 2. Traits
- Traits are used to share common functionality across multiple classes.
- Example: `ApiResponse` trait provides consistent JSON API responses like `successResponse()` and `errorResponse()`.
- This reduces code duplication and improves maintainability.

### 3. Enums
- PHP 8.1+ Enumerations define fixed status values such as `new`, `preparing`, `cancelled`.
- This ensures data integrity and prevents invalid string values.

### 4. Events & Listeners
- Laravel’s event system decouples application logic and enhances extensibility.
- The `StockTransferStatusChanged` event broadcasts real-time updates when a status changes.
- The `SendStatusNotification` listener handles side effects like logging or notifications.

### 5. Spatie Permission Package
- Used for managing roles and permissions like `sending_warehouse`, `receiving_warehouse`, and `shipping_integration`.
- Simplifies access control and secures the system.

### 6. Sanctum Authentication
- Laravel Sanctum is used to authenticate API requests securely.
- Supports token-based authentication for frontend and mobile clients.

### 7. DataTables Integration
- Server-side processing of DataTables for efficient, paginated, searchable, and sortable tables.
---

## Technologies

- Laravel 12 (PHP Framework)
- MySQL (Relational Database)
- PHP 8.1+
- Spatie Laravel Permission (Role & Permission management)
- Laravel Sanctum (Authentication)
- jQuery DataTables (Interactive tables)

---

## How to Run

1. Clone the repo  
2. Run `composer install`  
3. Set up `.env` file with database and Pusher credentials  
4. Run migrations and seeders (`php artisan migrate --seed`)  
5. Serve app: `php artisan serve`  
6. Access the frontend views and API endpoints

---

## Summary

This system demonstrates clean architecture principles using Laravel features like service layers, traits, enums, events, listeners, and robust role management with Spatie. It provides a solid foundation for building scalable, maintainable stock transfer applications with real-time capabilities.
