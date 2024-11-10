<?php

namespace APP\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteForumController extends Controller
{
    public function destroy($forumId){
        $forum = Forum::findOrFail($forumId);
        if($forum->image){
            Storage::delete($forum->image);
        }

        $forum->delete();

        session()->flash('flash.banner', 'Yay forum deleted successfully!');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('forum.edit-index')->with('success', 'Forum updated successfully');;
    }
}
