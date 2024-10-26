<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    function index(){
        $reportCount = Report::count();

        return view('admin.dashboard', compact('reportCount'));
    }
}
