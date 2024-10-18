<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(){
        $forums = Forum::orderBy('created_at', 'desc')
        ->orderBy('title', 'desc')
        ->paginate(10);
        return view('forum', compact('forums'));
    }

    public function show(){
        return view('');
    }
}
