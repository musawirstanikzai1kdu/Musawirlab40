# Laravel 12 Authentication Lab — Complete Solution

This is a set of solution files to copy into a fresh Laravel 12 project. It is **not** a full Laravel installation: Composer dependencies and the framework are not bundled.

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL and a database manager such as phpMyAdmin
- Laravel 12 project

## 1. Create the project

For a new lab project, run:

```bash
composer create-project laravel/laravel it-auth-lab "^12.0"
cd it-auth-lab
```

If you already have the prepared lab project, open its root directory instead. Copy the supplied files into matching locations, replacing the generated `routes/web.php` and `app/Http/Controllers/AuthController.php` for this dedicated lab project.

## 2. Create the database and configure `.env`

Create an empty MySQL database named `it_auth_lab`. Set the following values in `.env`, changing username/password if required:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=it_auth_lab
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
```

Then run:

```bash
php artisan config:clear
php artisan migrate
```

Keep Laravel's default `App\Models\User` model and default users migration.

## 3. Copy the solution files

Copy these files into the same paths in your Laravel project:

- `routes/web.php`
- `app/Http/Controllers/AuthController.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/dashboard.blade.php`

Create `resources/views/auth` if it does not exist.

## 4. Start and verify the application

```bash
php artisan route:list
php artisan serve
```

Visit `http://127.0.0.1:8000`. Check that the routes named `register`, `register.store`, `login`, `login.store`, `dashboard`, and `logout` are listed.

## Test checklist

1. Open `/dashboard` when signed out; it must redirect to login.
2. Register with a new name, email, and password of at least 8 characters; confirm the password matches.
3. Confirm the login page displays `Account created. Please log in.`.
4. In the `users` table, verify the password field contains a hash, not the original password.
5. Try to register the same email again; validation must fail and no extra user should be created.
6. Try a short password and mismatched confirmation; both must fail.
7. Log in with correct credentials; the dashboard should show the signed-in account's name and email.
8. Log in with a wrong password; an error should appear and the dashboard must remain protected.
9. While signed in, visit `/login`; the guest middleware should redirect away from the login form according to the application's guest redirect configuration.
10. Log out, then revisit `/dashboard`; it must require login again.
11. Register/log in with a second test account and verify the dashboard shows that second account's details.

## Answers to instructor questions

**1. Why use `Hash::make()` when saving a new password?**
It converts the plain-text password into a one-way password hash before it is stored. The actual password should not be stored directly in the database.

**2. How does `auth` middleware protect the dashboard?**
It checks whether the request has an authenticated user. If not, Laravel redirects the visitor to the login page instead of returning the protected dashboard.

**3. What does `@csrf` add to a form?**
It adds a hidden CSRF token that Laravel checks on the POST request to help prevent cross-site request forgery.

## Notes

- The form's `required` and `minlength` attributes improve browser-side input checks, but server-side validation in the controller remains essential.
- `password_confirmation` is checked by Laravel's `confirmed` validation rule; it is not saved to the database.
- `Auth::attempt()` receives the submitted plain-text password and compares it to the stored hash. Do not call `Hash::make()` on the submitted password during login.
- Regenerating the session after successful login helps prevent session-fixation attacks. Logout invalidates the session and regenerates its CSRF token.
