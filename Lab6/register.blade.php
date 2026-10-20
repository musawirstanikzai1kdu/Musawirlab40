<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account | IT Student Portal</title>
</head>
<body>
    <main>
        <h1>Create an account</h1>

        @if ($errors->any())
            <div role="alert">
                <p>Please fix the following errors:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <p role="status">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div>
                <label for="name">Full name</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name') }}" maxlength="255" required autocomplete="name">
            </div>

            <div>
                <label for="email">Email address</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}" maxlength="255" required autocomplete="email">
            </div>

            <div>
                <label for="password">Password (at least 8 characters)</label>
                <input id="password" name="password" type="password"
                       minlength="8" required autocomplete="new-password">
            </div>

            <div>
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       minlength="8" required autocomplete="new-password">
            </div>

            <button type="submit">Register</button>
        </form>

        <p><a href="{{ route('login') }}">Already have an account? Log in</a></p>
    </main>
</body>
</html>
