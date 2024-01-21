<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<!-- ===================PROJECT SUMMARY=================== -->

# Employee System

This project is a Laravel-based Employee Management System.

## Summary

This Laravel project implements an Employee System with the following features:

-   Admin authentication with a dedicated admin dashboard.
-   User-friendly interface for managing employees.
-   Employee registration, login, and dashboard functionality.

Key Components:

1.Controllers:
AdminController.php: Handles admin-related functionalities.
EmployeeController.php: Manages employee-related functionalities.

2.Middleware:
AdminAuthenticate.php: The provided middleware (AdminAuthenticate) is intended for authentication specifically for the admin guard in Laravel.Here's a brief explanation of each method:

1. redirectTo method:

This method determines the URL to which the user should be redirected if they are not authenticated. If the request expects JSON, it returns null to handle unauthenticated JSON requests without redirection. Otherwise, it returns the URL of the login page (route('login')).

2. authenticate method:

This method is responsible for authenticating the user for the specified guards. In this case, it checks if the admin guard is authenticated using $this->auth->guard('admin')->check(). If the admin guard is authenticated, it sets the guard to use with $this->auth->shouldUse('admin').
If the admin guard is not authenticated, it calls the unauthenticated method to handle the unauthenticated request, passing ['admin'] as the array of guards.

In summary, this middleware is designed to ensure that users accessing routes protected by the admin guard are properly authenticated. If not, it redirects them to the login page. This middleware should be assigned to routes or route groups that require admin authentication.

AdminRedirectIfAuthenticated.php :
This middleware (AdminRedirectIfAuthenticated) is designed to handle incoming requests. Its purpose is to check if a user is authenticated as an admin. If the admin is authenticated, it redirects them to the admin dashboard. If not authenticated, it allows the request to proceed to the next middleware in the pipeline.

3.Views:
admin/user: Blade templates for admin-related views.
employee/: Blade templates for employee-related views.
layouts/app.blade.php: Main layout file.

## Routes

-   `/register`: Employee register route.
-   `/admin/login`: Admin login page.
-   `/admin/dashboard`: Admin dashboard.
-   `/admin/logout`: Admin logout.
-   `/admin/employee/{employeeId}`: Add remarks to employee by admin.
-   `/admin/remark/{employeeId}`: View remarks for an employee.

## How to Access the Admin Dashboard

To access the admin login, navigate to [http://127.0.0.1:8000/admin/login].If you're already login, you will be redirected to the dashboard page.

To access the admin dashboard, navigate to [http://127.0.0.1:8000/admin/dashboard].If you're not authenticated, you will be redirected to the login page.

## How to Run the Project

1. Clone the repository.
2. Install dependencies with `composer install` and `npm install`.
3. Configure your database in the `.env` file.
4. Run migrations with `php artisan migrate`.
5. Start the Laravel server with `php artisan serve`.

