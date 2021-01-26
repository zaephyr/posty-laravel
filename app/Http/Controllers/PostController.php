<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function _construct()
    {
        return middleware(["auth"])->only(["store", "destroy"]);
    }

   public function index()
   {
       $posts = Post::latest()->with(["user", "likes"])->paginate(15);

       return view("posts.index", [
           "posts" => $posts
       ]);
   }

   public function store(Request $request)
   {
       $this->validate($request, [
           "body" => "required"
       ]);

       $request->user()->posts()->create($request->only("body"));
       //   auth()->user()->posts()->create();

       return back();
   }

   public function show(Post $post)
   {
       return view("posts.show", [
           "post" => $post
       ]);
   }

   public function destroy(Post $post, Request $request)
   {
       $this->authorize("delete", $post);
       
       $post->delete();
       
       return back();
   }
}
