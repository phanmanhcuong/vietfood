<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class WelcomeController extends Controller
{
    public function index(){
        //get posts which are liked
        $posts_like = \DB::table('user_like')->join('posts', 'user_like.post_id', '=', 'posts.id')->select('posts.*', \DB::raw('COUNT(*) as like_count'))->groupBy('posts.id', 'posts.user_id', 'posts.image_url', 'posts.title', 'posts.content', 'posts.restaurant_name', 'posts.created_at', 'posts.updated_at')->orderBy('posts.updated_at', 'DESC')->get();
        
        //get posts which are not liked
        $id_not_like = \DB::table('user_like')->select('post_id');
        $posts_no_like = \DB::table('posts')->select('posts.*')->whereNotIn('id', $id_not_like)->get();
        
        //put 2 arrays into 1
        foreach ($posts_like as $like){
            $posts[] = $like;
        }
        foreach ($posts_no_like as $no_like){
            $posts[] = $no_like;
        }
        
        //sort new array by update_at
        usort($posts, function($a, $b) {
            return $b->updated_at <=> $a->updated_at;
        });
        
        return view('welcome', [
            'posts' => $posts,
        ]);
    }
}
