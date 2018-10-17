<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Auth;

class UserPostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }

    public function show($id)
    {
        $post = Post::find($id);
        $like_exists = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->where('status', true)->get();
        if(count($like_exists) > 0) {
            $like_exist = 1;
        } else {
            $like_exist = 0;
        }
        $dislike_exists = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->where('status', false)->get();
        if(count($dislike_exists) > 0) {
            $dislike_exist = 1;
        } else {
            $dislike_exist = 0;
        }
        $post->views_count ++;
        $post->save();

        return view('viewpost')->with(['post' => $post, 'like_exist' => $like_exist, 'dislike_exist' => $dislike_exist]);
    }

    public function like($id)
    {
        $post = Post::find($id);
        $dislike_exists = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->where('status', false)->get();
        if(count($dislike_exists) > 0) {
            $post->dislikes --;
            foreach($dislike_exists as $dislike_exist){
                $dislike_remove = Like::find($dislike_exist->id);
                $dislike_remove->delete();
            }
        }
        $post->likes ++;
        $post->save();
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->status = true;
        $like->post_id = $post->id;
        $like->save();
        // if($like_exists == []){
        //     return view('viewpost')->with(['post' => $post]);
        // }
        // foreach($like_exists as $like_exist) {
        //     return $like_exist->status;
        //     foreach($like_exist as $like_ex){
        //         if($like_ex['status'] == true){
        //             $like_ex = true;
        //         } else {
        //             $like_ex = false;
        //         }
        //     }
        // }
        return redirect('/viewpost/'.$post->id);
    }

    public function dislike($id)
    {
        $post = Post::find($id);
        $like_exists = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->where('status', true)->get();
        if(count($like_exists) > 0) {
            $post->likes --;
            foreach($like_exists as $like_exist){
                $like_remove = Like::find($like_exist->id);
                $like_remove->delete();
            }
        }
        $post->dislikes ++;
        $post->save();
        $dislike = new like;
        $dislike->user_id = Auth::user()->id;
        $dislike->status = false;
        $dislike->post_id = $post->id;
        $dislike->save();
        // foreach($dislike_exists as $dislike_exist) {
        //     if($dislike_exist !== null){
        //         $dislike_exist = true;
        //     } else {
        //         $dislike_exist = false;
        //     }
        // }
        return redirect('/viewpost/'.$post->id);
    }
}
