<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment' =>'required',
        ]);
        $comment = new \App\Models\Comment;
        $comment->content = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->save();
        return redirect()->back();
    }
}
