<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;

class ForumManagementControler extends Controller
{
    public function index()
    {
        // Get only reported forums
        $forums = Forum::whereHas('report')
        ->select('forums.*', 'reports.report_count')
            ->join('reports', 'forums.id', '=', 'reports.forum_id')
            ->orderBy('reports.report_count', 'desc')
            ->paginate(15);

        return view('admin.forum-management', compact('forums'));
    }

}
