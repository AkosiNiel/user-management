<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <h1 class="logo">🛠 Admin Dashboard</h1>
        </div>
        <div class="navbar-right">
            <span class="user">👨🏻‍💼 {{ Auth::user()->username }}</span>
            <a href="{{ route('users.index') }}">Manage Users</a>
            @if(Auth::user()->role === 'superadmin')
                <a href="{{ route('users.create') }}">Create User</a>
            @endif
            <a href="{{ route('logout') }}" class="logout">Logout</a>
        </div>
    </header>

    <main class="content-area">
        <div class="welcome">
            <h2>Welcome back, {{ Auth::user()->username }}!</h2>
            <p>Use the navigation above to manage your application.</p>

            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif
        </div>
    </main>
</body>
</html>
