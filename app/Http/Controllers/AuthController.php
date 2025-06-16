<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Ipinapakita ang login form page sa user
    public function showLogin() {
        return view('auth.login');
    }

    // Nagha-handle ng login logic ng user
    public function login(Request $request) {
        // Validate ng user input (required ang email at password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Kinukuha ang user base sa email at tinitingnan kung active siya 
        $user = User::where('email', $request->email)->where('status', 1)->first();

        // Kung may nakita na user at tama ang password
        if ($user && Hash::check($request->password, $user->password)) {
            // I-login ang user gamit ang Auth facade
            Auth::login($user);

            // Redirect papuntang dashboard after successful login
            return redirect()->route('dashboard');
        }

        // Kapag mali ang credentials o inactive ang user
        return back()->withErrors(['email' => 'Invalid credentials or inactive user.']);
    }

    // Naglo-logout sa user at ireredirect pabalik sa login page
    public function logout() {
        Auth::logout(); 
        return redirect()->route('login'); 
    }
}
