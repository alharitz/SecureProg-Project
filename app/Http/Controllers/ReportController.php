<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportForum($forumId){
        $report = Report::where('forum_id', $forumId)->first();
        $forum = Forum::where('id', $forumId)->first();

        if($forum->user_id === Auth::id()){
            return redirect()->route('forum.show', ['forumId' => $forumId])->with('error', 'Sorry you cannot report your own forum');
        }

        if($report){
            $report->increment('report_count');
        }else{
            Report::create([
                'forum_id' => $forumId,
                'report_count' => 1,
            ]);
        }

        return redirect()->route('forum.show', ['forumId' => $forumId])->with('success', 'Forum report has been created');
    }
}
