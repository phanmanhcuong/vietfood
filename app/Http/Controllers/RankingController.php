<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Post;

class RankingController extends Controller
{
    public function like(){
        $posts = \DB::table('user_like')->join('posts', 'user_like.post_id', '=', 'posts.id')->select('posts.*', \DB::raw('COUNT(*) as like_count'))->groupBy('posts.id', 'posts.user_id', 'posts.image_url', 'posts.title', 'posts.content', 'posts.restaurant_name', 'posts.created_at', 'posts.updated_at')->orderBy('like_count', 'DESC')->take(10)->get();

        return view('ranking.like', ['posts' => $posts,]);
    }
}
