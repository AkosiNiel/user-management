<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('css/user-details.css') }}"> -->
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>User Details</h1>

        <div class="card">
            <h2>{{ $user->username }}</h2>
            <p><strong>Name:</strong> {{ $user->profile->firstname }} {{ $user->profile->middlename }} {{ $user->profile->lastname }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Company:</strong> {{ $user->profile->company }}</p>
            <p><strong>Address:</strong> {{ $user->profile->address }}</p>
            <p><strong>Contact Number:</strong> {{ $user->profile->contact_number }}</p>
            <p><strong>Position:</strong> {{ $user->profile->position }}</p>
            <p><strong>Status:</strong> {{ $user->status ? 'Active' : 'Inactive' }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        </div>

        <a href="{{ route('users.index') }}" class="btn">Back to Users</a>
    </div>
</body>
</html>
