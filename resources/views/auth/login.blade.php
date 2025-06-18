<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
      <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<body>
<div class="login-container">
    <h2>Login</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
        <button type="reset">Reset</button>
    </form>
</div>
</body>
</html>
