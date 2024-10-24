<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportForum($forumId){
        $report = Report::where('forum_id', $forumId)->first();

        if($report){
            $report->increment('report_count');
        }else{
            Report::create([
                'forum_id' => $forumId,
                'report_count' => 1,
            ]);
        }

        return redirect()->route('forum.show', ['forumId' => $forumId]);
    }
}
