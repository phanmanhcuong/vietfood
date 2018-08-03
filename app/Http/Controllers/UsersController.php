<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use App\User;
use App\Post;

class UsersController extends Controller
{
    public function showEditProfileForm($id){
        $user = User::find($id);
        
        return view('users.edit_profile_form', ['user' => $user,]);
    }
    
    public function edit_profile(Request $request, $id){
        $this->validate($request, ['name'=>'required|max:191', 'gentle' => 'required',]);
        
        $user = User::find($id);
        if($request->name != null){
            $user->name = $request->name;
        }
        
        if($request->gentle != null){
            $user->gentle = $request->gentle;
        }
        
        if($request->birthday != null){
            $birthday = strtotime($request->birthday);
            $format_birthday = date('Y-m-d', $birthday);
            $user->birthday = $format_birthday;
        }
        
        $file = $request->file('image1');
        $path = Storage::disk('s3')->putFile('avatar-folder', $file, 'public');
        $url = Storage::disk('s3')->url($path);
        $user->avatar_url = $url;
        
        $user->save();
        return redirect()->back();
    }
    
    public function show_posts($id){
        $user = User::find($id);
        $posts = [];
        
        $posts_like = \DB::table('user_like')->join('posts', 'user_like.post_id', '=', 'posts.id')->join('users', 'posts.user_id', '=', 'users.id')->select('posts.*', \DB::raw('users.name as user_name, users.id as user_id, COUNT(*) as like_count'))->where('posts.user_id', $user->id)->groupBy('posts.id', 'posts.user_id', 'posts.image_url', 'posts.title', 'posts.content', 'posts.restaurant_name', 'posts.created_at', 'posts.updated_at', 'users.name', 'users.id')->get();
        
        //get posts which are not liked
        $id_not_like = \DB::table('user_like')->select('post_id');
        $posts_no_like = \DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->select('posts.*', \DB::raw('users.name as user_name, users.id as user_id'))->where('posts.user_id', $user->id)->whereNotIn('posts.id', $id_not_like)->get();
            
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
        
        return view('users.show_posts', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }
    
    public function search_posts($id){
        $keyword = request()->keyword;
        $posts = [];
        $user = User::find($id);
        
        if($keyword){
            $posts_like = \DB::table('user_like')->join('posts', 'user_like.post_id', '=', 'posts.id')->join('users', 'posts.user_id', '=', 'users.id')->select('posts.*', \DB::raw('users.name as user_name, users.id as user_id, COUNT(*) as like_count'))->where([['posts.user_id', $user->id], ['posts.title', 'like', "%$keyword%"]])->groupBy('posts.id', 'posts.user_id', 'posts.image_url', 'posts.title', 'posts.content', 'posts.restaurant_name', 'posts.created_at', 'posts.updated_at', 'users.name', 'users.id')->get();
            
            //get posts which are not liked
            $id_not_like = \DB::table('user_like')->select('post_id');
            $posts_no_like = \DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->select('posts.*', \DB::raw('users.name as user_name, users.id as user_id'))->where([['posts.user_id', $user->id], ['posts.title', 'like', "%$keyword%"]])->whereNotIn('posts.id', $id_not_like)->get();
                
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
        }
        
        return view('users.show_posts', [
            'posts' => $posts,
            'user' => $user,
            'keyword' => $keyword,
        ]);
    }
}
