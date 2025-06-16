<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/user-list.css') }}">
</head>
<body>
    <div class="container">
        <header class="page-header">
            <h1>User Management</h1>
            <div class="header-actions">
                <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
                <a href="{{ route('users.create') }}" class="btn primary">Add User</a>
            </div>
        </header>

        <form method="GET" action="{{ route('users.index') }}" class="search-form">
            <label for="search" class="visually-hidden">Search users</label>
            <input type="text" id="search" name="search" placeholder="Search name or username" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="user-name-link">
                                    {{ optional($user->profile)->firstname }} {{ optional($user->profile)->lastname }}
                                </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ optional($user->profile)->company ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $user->status ? 'active' : 'inactive' }}">
                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td class="actions">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn small">Edit</a>
                                @if (Auth::user()->role === 'superadmin')
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')" class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn small danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
        <div class="pagination">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</body>
</html>
