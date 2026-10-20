# Upload this lab to GitHub

## Important
This package contains the lab solution files, not a complete Laravel installation. To make a runnable GitHub repository, first create a Laravel 12 project, copy these files into that project, and upload the **whole Laravel project root**. Do not upload only this package if you want other people to clone and run the app directly.

## 1. Create the Laravel project

```bash
composer create-project laravel/laravel it-auth-lab "^12.0"
cd it-auth-lab
```

## 2. Copy the solution files into the project

Copy these paths from this package into the same paths in your Laravel project, replacing the existing files where the path already exists:

- `routes/web.php`
- `app/Http/Controllers/AuthController.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/dashboard.blade.php`

The Laravel project also needs its original framework files, including `artisan`, `composer.json`, `bootstrap/`, `config/`, `app/Models/User.php`, and `database/migrations/`. Keep those original files.

## 3. Configure the database locally

Create a MySQL database named `it_auth_lab` and set the database variables in your local `.env` file. Never commit `.env` or real passwords to GitHub. Use `.env.example` as a non-secret template if you maintain one in your full project.

```bash
php artisan config:clear
php artisan migrate
php artisan route:list
php artisan serve
```

Visit `http://127.0.0.1:8000` and test registration, login, dashboard protection, and logout.

## 4. Upload the full project using Git

Create an empty repository on GitHub, then run these commands from the Laravel project root. Replace the URL with your own repository URL:

```bash
git init
git add .
git status
git commit -m "Complete Laravel 12 authentication lab"
git branch -M main
git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPOSITORY.git
git push -u origin main
```

Before `git commit`, check `git status` and confirm `.env`, `vendor/`, and `node_modules/` are not staged. The standard Laravel `.gitignore` should exclude generated dependencies and environment secrets.

## Included files

- `routes/web.php`
- `app/Http/Controllers/AuthController.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/dashboard.blade.php`
- `README.md`

This package has been syntax-checked where PHP is available, but it has not been executed against your local MySQL instance.
