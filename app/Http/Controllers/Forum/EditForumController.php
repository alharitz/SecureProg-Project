<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForumStoreRequest;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditForumController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $forums = Forum::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->orderBy('title', 'asc')
            ->paginate(15);

        return view('forum.edit-forum', compact('forums'));
    }

    public function edit($forumId){
        $forum = Forum::findOrFail($forumId);
        return view('forum.show-edit-forum', compact('forum'));
    }

    public function update(ForumStoreRequest $request, $forumId){
        $imagePath = null;
        $forum = Forum::findOrFail($forumId);

        $validated = $request->validated();

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($forum->image) {
                Storage::delete($forum->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('forum-images', 'public');
            $forum->image = $imagePath;
        }

        Forum::where('id', $forumId)->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'forum_images_path' => $imagePath,
        ]);

        return redirect()->route('forum.edit-forum', compact('forumId'))->with('success', 'Forum updated successfully');
    }
}
