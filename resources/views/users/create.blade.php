<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="{{ asset('css/create-user.css') }}">
</head>
<body>

<div class="container">
    <h2>Create User</h2>
    <a href="{{ route('users.index') }}">Back to User List</a>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <fieldset>
            <legend>User Account</legend>
            <label>Username:</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Retype Password:</label>
            <input type="password" name="password_confirmation" required>
        </fieldset>

        <fieldset>
            <legend>User Profile</legend>
            <label>First Name:</label>
            <input type="text" name="firstname" value="{{ old('firstname') }}" required>

            <label>Middle Name:</label>
            <input type="text" name="middlename" value="{{ old('middlename') }}" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" value="{{ old('lastname') }}" required>

            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address') }}" required>

            <label>Company:</label>
            <input type="text" name="company" value="{{ old('company') }}" required>

            <label>Contact Number:</label>
            <input type="text" name="contact_number" value="{{ old('contact_number') }}" required>

            <label>Position:</label>
            <input type="text" name="position" value="{{ old('position') }}" required>

            <label>Status:</label>
            <select name="status" required>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Deactivated</option>
            </select>
        </fieldset>

        <button type="submit">Save User</button>
        <button type="reset">Reset</button>
    </form>
</div>

</body>
</html>
