<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/edit-user.css') }}">
      
</head>
<body>
    <div class="edit-container">
        <h2>Edit User: {{ $user->username }}</h2>
        <a href="{{ route('users.index') }}">← Back to User List</a>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <label>Username (cannot be changed):</label>
            <input type="text" value="{{ $user->username }}" disabled>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

            <label>First Name:</label>
            <input type="text" name="firstname" value="{{ old('firstname', optional($user->profile)->firstname) }}" required>

            <label>Middle Name:</label>
            <input type="text" name="middlename" value="{{ old('middlename', optional($user->profile)->middlename) }}" required>


            <label>Last Name:</label>
            <input type="text" name="lastname" value="{{ old('lastname', optional($user->profile)->lastname) }}" required>

            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address', optional($user->profile)->address) }}" required>


            <label>Company:</label>
            <input type="text" name="company" value="{{ old('company', optional($user->profile)->company) }}" required>


            <label>Contact Number:</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', optional($user->profile)->contact_number) }}" required>


           <label>Position:</label>
           <input type="text" name="position" value="{{ old('position', optional($user->profile)->position) }}" required>


            <label>Status:</label>
            <select name="status" required>
                <option value="1" {{ $user->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$user->status ? 'selected' : '' }}>Deactivated</option>
            </select>

            <button type="submit" onclick="return confirm('Are you sure you want to update this user?')">Update</button>
        </form>
    </div>
</body>
</html>
