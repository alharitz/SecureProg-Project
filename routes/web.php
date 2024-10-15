<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ForumManagementControler;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\User\CreateForumController;
use App\Http\Controllers\User\EditForumController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authenticated routes
Route::middleware([

    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/home', function(){
        // Check if the user is authenticated and an admin
        if (!Auth::check()) {
            return redirect()->route('login');
          }
  
          if (Auth::user()->is_admin) {
              // Redirect to admin dashboard if the user is an admin
              if(request()->route()->getName() !== 'admin.dashboard'){
                  return redirect()->route('admin.dashboard');
              }
          } else {
              // Otherwise, redirect to user home page
              if(request()->route()->getName() !== 'user.home'){
                  return redirect()->route('user.home');
              }
          }
    })->name('home');

    Route::middleware([CheckIfAdmin::class])->group(function () {
        // Admin-only routes
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/forum-management', [ForumManagementControler::class, 'index'])->name('forum-management');
        Route::get('/admin/user-management', [UserManagementController::class, 'index'])->name('user-management');
    });

    // User routes
    Route::get('/user/home', [UserController::class, 'index'])->name('user.home');
    Route::get('/user/create-forum', [CreateForumController::class, 'index'])->name('create-forum');
    Route::get('/user/edit-forum', [EditForumController::class, 'index'])->name('edit-forum');
});
