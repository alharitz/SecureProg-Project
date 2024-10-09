<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated and an admin
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                // Redirect to admin dashboard if the user is an admin
                return redirect()->route('admin.dashboard');
            } else {
                // Otherwise, redirect to user home page
                return redirect()->route('user.home');
            }
        }

        // Optional: handle unauthenticated state
        return redirect()->route('login');
    }

    public function adminDashboard()
    {
        // Admin-specific dashboard logic (admin view)
        return view('admin.dashboard');
    }

    public function userHome()
    {
        // User-specific home logic (user view)
        return view('user.home');
    }
}
