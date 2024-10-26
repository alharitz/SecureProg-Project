<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    public function review($forumId){
        // Find the forum
        $forum = Forum::findOrFail($forumId); // Use findOrFail for automatic 404

        // Retrieve the comments related to the forum, including replies
        $comments = Comment::where('forum_id', $forum->id)
            ->whereNull('parent_id') // Fetch only root comments (no parent)
            ->with('replies') // Load replies using eager loading
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Return view with forum and its comments
        return view('admin.show-report-forum', compact('forum', 'comments'));
    }
}
