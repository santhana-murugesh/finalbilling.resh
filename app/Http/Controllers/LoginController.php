<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function login(Request $request)
{
    \Log::info('Login attempt', [
        'email' => $request->email,
        'expects_json' => $request->expectsJson(),
        'headers' => $request->headers->all()
    ]);

    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    \Log::info('User lookup result', [
        'user_found' => $user ? true : false,
        'user_id' => $user ? $user->id : null,
        'user_email' => $user ? $user->email : null
    ]);

    if ($user && Hash::check($request->password, $user->password)) {
        auth()->login($user);
        
        \Log::info('Login successful', ['user_id' => $user->id]);
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Login successful',
                'redirect' => route('dashboard')
            ]);
        }
        
        return redirect()->route('dashboard'); 
    }

    \Log::warning('Login failed', [
        'email' => $request->email,
        'user_exists' => $user ? true : false,
        'password_correct' => $user ? Hash::check($request->password, $user->password) : false
    ]);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => false, 
            'message' => 'Invalid credentials.'
        ], 422);
    }

    return back()->withErrors([
        'login_error' => 'Invalid credentials.',
    ])->withInput();
}

public function logout(Request $request)
{
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

public function signuppage()
{
    return view('signup'); 
}

public function dashboard()
{
    return view('dashboard'); 
}

public function signup(Request $request)
{
    // Disable signup functionality
    return redirect()->route('login')->withErrors(['signup_error' => 'Signup is disabled. This is a single-user system.']);
}

public function editProfile()
{
    $user = auth()->user();
    return view('edit-profile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = auth()->user();
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'current_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:8|confirmed',
    ]);

    // Update basic info
    $user->name = $request->name;
    $user->email = $request->email;

    // Update password if provided
    if ($request->filled('current_password') && $request->filled('new_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Invalid credentials.'])->withInput();
        }
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
}
}
