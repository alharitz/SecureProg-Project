<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class UserManagementController extends Controller
{
    function index(){
        $users = User::orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user-management', compact('users'));
    }

    public function delete($userId){
        $user = User::find($userId);

        if($user && $user->is_admin){
            return redirect()->route('user-management')->with('errors', 'Cannot delete an admin user');
        }

        User::destroy($userId);

        return redirect('/admin/user-management')->with('success', 'An impostor successfully deleted!, stay aware admin >:)');
    }
}
