<?php

use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Home Route
Route::middleware([

    // Check is Aunteticated middleware
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // General route that redirects users based on their role
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Admin-only route
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])
        ->middleware(CheckIfAdmin::class)  // Apply admin middleware
        ->name('admin.dashboard');
    
    // Regular user home
    Route::get('/user/home', [HomeController::class, 'userHome'])->name('user.home');
});

// benerin route namenya di navbar, juga pasanngin middleware CheckIfAdmin
Route::get('/forum-management', function () {
    return view('admin.forum-management');
})->name('forum-management');

Route::get('/user-management', function () {
    return view('admin.user-management');
})->name('user-management');
