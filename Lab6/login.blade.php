<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | IT Student Portal</title>
</head>
<body>
    <main>
        <h1>Log in</h1>

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

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div>
                <label for="email">Email address</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password"
                       required autocomplete="current-password">
            </div>

            <button type="submit">Log in</button>
        </form>

        <p><a href="{{ route('register') }}">Create a new account</a></p>
    </main>
</body>
</html>
