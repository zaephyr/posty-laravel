<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
   public function index()
   {
       return view("posts.index");
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
}
