<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\addPostRequest;
use App\Http\Requests\updatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create',compact('categories'));
    }

    public function store(addPostRequest $request)
    {
        $path = Storage::disk('public')->put('posts', $request->file('image'));
        Post::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->post_category,
            'title' => $request->title,
            'image' => $path,
            'body' => $request->editor1
        ]);

        return redirect()->route('listPosts')->with(['message' => 'Post successfully created!']);
    }

    public function show(Post $post)
    {
        // check status of post
        if ($post->status == 0 && !(Auth::check())){
            return redirect()->route('home');
        }
        $categories = Category::all();
        $comments = $post->comments;
        return view('post.show', compact('post', 'categories','comments'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.update', compact('post','categories'));
    }

    public function update(updatePostRequest $request, Post $post)
    {
        $path = $post->image;
        // check if request has file
        if($request->hasFile('image')){
            // check if file exists
            $exists = Storage::disk('public')->exists($post->image);
            if ($exists){
                // delete old image
                Storage::disk('public')->delete($post->image);
                // move new image
                $path = Storage::disk('public')->put('posts', $request->file('image'));
            }
        }

        $post->update([
            'title' => $request->title,
            'category_id' => $request->post_category,
            'status' => $request->post_status,
            'image' => $path,
            'body' => $request->editor1
        ]);
        return redirect()->route('listPosts')->with(['message' => 'Post successfully updated!']);
    }

    public function destroy(Post $post)
    {
        // check if file exists
        $exists = Storage::disk('public')->exists($post->image);
        if ($exists){
            // delete old image
            Storage::disk('public')->delete($post->image);
        }
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('listPosts')->with(['message' => 'Post successfully deleted!']);
    }
}
