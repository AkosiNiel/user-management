<?php

namespace App\Http\Controllers; 

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; 

class UserController extends Controller
{
    // Method para sa dashboard view (home page ng user or admin)
    public function dashboard()
    {
        return view('dashboard');
    }

    // Ipapakita ang listahan ng users, with optional search
    public function index(Request $request)
    {
        // Kukunin ang users with their profile, with search capability
        $users = User::with('profile')
            ->when($request->search, function ($q, $search) {
                // Search sa username or firstname/lastname ng profile
                $q->where('username', 'like', "%$search%")
                    ->orWhereHas('profile', function ($q) use ($search) {
                        $q->where('firstname', 'like', "%$search%")
                          ->orWhere('lastname', 'like', "%$search%");
                    });
            })
            ->paginate(5); // Ipaginate natin, 5 per page

        return view('users.index', compact('users'));
    }

    // Ipakita ang specific na user at profile
    public function show(User $user)
    {
        $user->load('profile'); // Load user profile relationship
        return view('users.show', compact('user'));
    }

    // Form para gumawa ng bagong user
    public function create()
    {
        return view('users.create');
    }

    // Logic para i-save ang bagong user at profile sa database
    public function store(Request $request)
    {
        // Validation ng user input bago i-save
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required|string',    
            'middlename' => 'nullable|alpha',
            'lastname' => 'required|string',
            'address' => 'required|regex:/^[\w\s\#\.\,\-]+$/',
            'company' => 'required|string',
            'contact_number' => 'required|numeric',
            'position' => 'required|string',
            'status' => 'required|boolean',
        ]);

        // Gumagawa ng bagong user sa users table
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'status' => $request->status,
            'role' => 'user', // Default role is 'user'
        ]);

        // Gumawa ng profile gamit ang user relationship
        $user->profile()->create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'company' => $request->company,
            'contact_number' => $request->contact_number,
            'position' => $request->position,
        ]);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    // Ipakita ang edit form para sa user at profile
    public function edit(User $user)
    {
        $user->load('profile'); // Load profile data para sa form
        return view('users.edit', compact('user'));
    }

    // Logic para i-update ang user at profile data
    public function update(Request $request, User $user)
    {
        // Validation for updating (email should be unique maliban sa current user)
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'firstname' => 'required|string',
            'middlename' => 'nullable|alpha',
            'lastname' => 'required|string',
            'address' => 'required|regex:/^[\w\s\#\.\,\-]+$/',
            'company' => 'required|string',
            'contact_number' => 'required|numeric',
            'position' => 'required|string',
            'status' => 'required|boolean',
        ]);

        // Update ng user table
        $user->update([
            'email' => $request->email,
            'status' => $request->status,
        ]);

        // Update ng profile table gamit ang relationship
        $user->profile->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'company' => $request->company,
            'contact_number' => $request->contact_number,
            'position' => $request->position,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    // Pang-delete ng user kasama ang profile via cascading
    public function destroy(User $user)
    {
        $user->delete(); // Delete user, automatic na rin madedelete profile kung naka-cascade
        return back()->with('success', 'User deleted.');
    }
}
