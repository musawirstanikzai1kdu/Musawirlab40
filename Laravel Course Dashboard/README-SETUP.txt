LARAVEL 12 COURSE DASHBOARD - COMPLETE FILES

Included complete files:
- app/Models/Course.php
- app/Http/Controllers/CourseController.php
- resources/views/dashboard.blade.php
- resources/views/courses/form.blade.php
- resources/views/courses/table.blade.php
- resources/views/courses/details.blade.php
- public/css/dashboard.css

ROUTES
The existing routes/web.php was not replaced because your working login,
signup, and logout controller/route definitions are specific to your project.
Use routes/course-routes.php.txt as the exact course-route block to merge into
routes/web.php.

Important:
1. Keep the existing login, signup, and POST logout routes.
2. Keep the logout route named "logout".
3. Add the CourseController and Route imports only once.
4. Remove old duplicate dashboard and courses.store routes.
5. Put the course routes inside one auth middleware group. If your web.php
   already has an auth group, add the six course routes inside that group
   instead of nesting another group.
6. Do not replace your database or run migrate:fresh.

DATABASE EXPECTATIONS
The existing courses table must contain:
- id (primary key)
- user_id (foreign key to users.id)
- course_code (VARCHAR(20))
- course_name (VARCHAR(150))
- credit_hours (unsigned tiny/small integer; allowed values 1-6)
- semester (VARCHAR(30))
- created_at and updated_at
- unique composite index on (user_id, course_code)

The model uses the existing column names. No migration is included because
this lesson expects the previous lesson's table to already exist.

ASSEMBLY
Copy each included file to the matching path in your Laravel project.
Create missing directories if necessary. Then merge the routes block.

RUN FROM THE FOLDER CONTAINING artisan:
php artisan optimize:clear
php artisan route:list --path=dashboard
php artisan route:list --path=courses
php artisan serve

Check that route names/methods are:
dashboard             GET
courses.store         POST
courses.edit          GET
courses.show          GET
courses.update        PUT
courses.destroy       DELETE

The application also expects a working authenticated user with a name field,
and the login process must redirect to route('dashboard').
The semester dropdown and server validation currently allow only Spring 2026
and Fall 2026, matching the supplied handout.
