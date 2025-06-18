<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <h1 class="logo">🛠 Dashboard</h1>
        </div>
        <div class="navbar-right">
            <span class="user">👤 {{ Auth::user()->username }}</span>
            @if(Auth::user()->role === 'superadmin')
                <a href="{{ route('users.index') }}">Manage Users</a>
                <a href="{{ route('users.create') }}">Create User</a>
            @else
                <a href="{{ route('users.edit', Auth::id()) }}">Edit Profile</a>
            @endif
            <a href="{{ route('logout') }}" class="logout">Logout</a>
        </div>
    </header>

    <main class="content-area">
        <div class="welcome">
            <h2>Welcome back, {{ Auth::user()->username }}!</h2>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if(Auth::user()->role !== 'superadmin')
                <div class="profile-box">
                    <h3>Your Information</h3>
                    <ul>
                        <li><strong>Name:</strong> {{ optional(Auth::user()->profile)->firstname }} {{ optional(Auth::user()->profile)->lastname }}</li>
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li><strong>Company:</strong> {{ optional(Auth::user()->profile)->company }}</li>
                        <li><strong>Position:</strong> {{ optional(Auth::user()->profile)->position }}</li>
                        <li><strong>Contact:</strong> {{ optional(Auth::user()->profile)->contact_number }}</li>
                        <li><strong>Status:</strong> {{ Auth::user()->status ? 'Active' : 'Inactive' }}</li>
                    </ul>
                </div>
            @else
                <p>Use the navigation above to manage users.</p>
            @endif
        </div>
    </main>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <h1 class="logo">🛠 Dashboard</h1>
        </div>
        <div class="navbar-right">
            <span class="user">👤 {{ Auth::user()->username }}</span>

            @if(Auth::user()->role === 'superadmin')
                <a href="{{ route('users.index') }}">Manage Users</a>
                <a href="{{ route('users.create') }}">Create User</a>
            @else
                {{-- ✅ Use correct route for regular user --}}
                <a href="{{ route('profile.edit') }}">Edit Profile</a>
            @endif

            <a href="{{ route('logout') }}" class="logout">Logout</a>
        </div>
    </header>

    <main class="content-area">
        <div class="welcome">
            <h2>Welcome back, {{ Auth::user()->username }}!</h2>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if(Auth::user()->role !== 'superadmin')
                <div class="profile-box">
                    <h3>Your Information</h3>
                    <ul>
                        <li><strong>Name:</strong> {{ optional(Auth::user()->profile)->firstname }} {{ optional(Auth::user()->profile)->lastname }}</li>
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li><strong>Company:</strong> {{ optional(Auth::user()->profile)->company }}</li>
                        <li><strong>Position:</strong> {{ optional(Auth::user()->profile)->position }}</li>
                        <li><strong>Contact:</strong> {{ optional(Auth::user()->profile)->contact_number }}</li>
                        <li><strong>Status:</strong> {{ Auth::user()->status ? 'Active' : 'Inactive' }}</li>
                    </ul>
                </div>
            @else
                <p>Use the navigation above to manage users.</p>
            @endif
        </div>
    </main>
</body>
</html>
