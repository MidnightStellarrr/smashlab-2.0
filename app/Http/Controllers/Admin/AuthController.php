<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // ✅ Use 'admin' guard
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
            // ✅ Get the user from 'admin' guard
            $user = Auth::guard('admin')->user();
            
            // ✅ Now check if the user exists and has the method
            if ($user && method_exists($user, 'isActive')) {
                if (!$user->isActive()) {
                    Auth::guard('admin')->logout();
                    return back()->withErrors([
                        'email' => 'Your account is inactive. Please contact the administrator.',
                    ]);
                }
            } else {
                // Fallback: if method doesn't exist, just log them in
                // This is a safety net
            }

            if (method_exists($user, 'updateLastLogin')) {
                $user->updateLastLogin($request);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid admin credentials.',
        ])->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}