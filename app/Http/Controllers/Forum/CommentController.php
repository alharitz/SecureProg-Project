<?php

namespace App\Http\Controllers\forum;

use App\Http\Controllers\Controller;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
        // Function for storing comment (comment pointing to the forum)
        public function store(CommentStoreRequest $request, $forumId){
            $validated = $request->validated();

           Comment::create([
                'forum_id' => $forumId,
                'parent_id'=> null,
                'user_id'=> Auth::id(),
                'content'=> $validated['comment'],
           ]);
           return redirect()->route('forum.show', $forumId)->with('success','Comment successfully upload');
        }

        // Function for show wing forum through API
        public function show($forumId){
                $comments = Comment::where('forum_id', $forumId)
                        ->orderBy('created_at','desc')
                        ->orderBy('content', 'desc')
                        ->paginate(10);

                return $comments;
        }
}
