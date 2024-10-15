<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateForumController extends Controller
{
    function index(){
        return view('user.create-forum');
    }
}

