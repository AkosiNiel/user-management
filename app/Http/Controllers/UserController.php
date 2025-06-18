<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Dashboard page
    public function dashboard()
    {
        $user = Auth::user()->load('profile');
        return view('dashboard', compact('user'));
    }

    // Superadmin: User listing
    public function index(Request $request)
    {
        $users = User::with('profile')
            ->where('role', '!=', 'superadmin')
            ->when($request->search, function ($q, $search) {
                $q->where('username', 'like', "%$search%")
                  ->orWhereHas('profile', function ($q) use ($search) {
                      $q->where('firstname', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%");
                  });
            })
            ->paginate(5);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('profile');
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
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

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'role' => 'user',
        ]);

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

    public function edit(User $user)
    {
        // Superadmin or the user themselves
        if (Auth::id() !== $user->id && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $user->load('profile');
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Superadmin or the user themselves
        if (Auth::id() !== $user->id && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'firstname' => 'required|string',
            'middlename' => 'nullable|alpha',
            'lastname' => 'required|string',
            'address' => 'required|regex:/^[\w\s\#\.\,\-]+$/',
            'company' => 'required|string',
            'contact_number' => 'required|numeric',
            'position' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        // Only superadmin can change status
        if (Auth::user()->role === 'superadmin') {
            $user->update([
                'email' => $request->email,
                'status' => $request->status ?? $user->status,
            ]);
        } else {
            $user->update([
                'email' => $request->email,
            ]);
        }

        $user->profile()->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'company' => $request->company,
            'contact_number' => $request->contact_number,
            'position' => $request->position,
        ]);

        return redirect()->route(
            Auth::user()->role === 'superadmin' ? 'users.index' : 'dashboard'
        )->with('success', 'Profile updated.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    // For regular user editing their own profile
    public function editOwn()
    {
        $user = Auth::user()->load('profile');
        return view('users.edit', compact('user'));
    }

    public function updateOwn(Request $request)
    {
        $user = Auth::user();
        return $this->update($request, $user);
    }
}
