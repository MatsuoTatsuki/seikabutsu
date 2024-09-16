<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request,Comment $comment,Post $post)
   {
       $input = $request['comment'];
       $comment->user_id = auth()->user()->id;
       $comment->fill($input)->save();
       $comment->save();

       return redirect('/posts/' . $comment->post_id);
   }
}
