<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\addPostComment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    public function store(Post $post,addPostComment $request){
        Comment::create([
            'post_id' => $post->id,
            'body' => $request->body
        ]);
        return back();
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return redirect()->back()->with(['message' => 'Comment Successfully deleted!']);
    }
}
