<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class UserLikeController extends Controller
{
    public function like(Request $request, $postId){
        \Auth::user()->like($postId);
        return redirect()->back();
    }
    
    public function unlike($postId){
        \Auth::user()->unlike($postId);
        return redirect()->back();
    }
}
