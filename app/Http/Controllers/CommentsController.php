<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentsController extends Controller
{
    public function comment(Request $request, $userId, $postId){
        $this->validate($request, ['content' => 'required']);
        
        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->post_id = $postId;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back();
        
    }
}
