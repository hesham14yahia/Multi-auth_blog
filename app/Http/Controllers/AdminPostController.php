<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Like;
use App\Admin;

class AdminPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'auth:admin']);
    }

    public function create()
    {
        return view('addpost');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->admin_id = Auth::user()->id;
        $post->save();

        return redirect('/home')->with('success', 'Post Updated');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('viewpost')->with(['post' => $post]);
    }
}
