<?php

namespace App\Http\Controllers\Frontdesk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontdesk.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // ✅ Use 'frontdesk' guard
        if (Auth::guard('frontdesk')->attempt($request->only('email', 'password'), $request->remember)) {
            // ✅ Get the user from 'frontdesk' guard
            $user = Auth::guard('frontdesk')->user();
            
            // ✅ Now check if the user exists and has the method
            if ($user && method_exists($user, 'isActive')) {
                if (!$user->isActive()) {
                    Auth::guard('frontdesk')->logout();
                    return back()->withErrors([
                        'email' => 'Your account is inactive. Please contact your supervisor.',
                    ]);
                }
            } else {
                // Fallback: if method doesn't exist, just log them in
                // This is a safety net
            }

            if (method_exists($user, 'updateLastLogin')) {
                $user->updateLastLogin($request);
            }

            return redirect()->route('frontdesk.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid frontdesk credentials.',
        ])->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::guard('frontdesk')->logout();
        return redirect()->route('frontdesk.login');
    }
}