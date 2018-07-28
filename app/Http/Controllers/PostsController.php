<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;

class PostsController extends Controller
{
    public function create(){
        $post = new Post();
        return view('posts.create', ['post' => $post]);
    }
    
    public function store(Request $request){
        $this->validate($request, ['image' => 'required', 'content' => 'required|max:191', 'restaurant_name' => 'required|max:191']);
        
        $file = $request->file('image');
        //dd($file);
        $path = Storage::disk('s3')->putFile('food-images', $file, 'public');
        $url = Storage::disk('s3')->url($path);
        
        $post = $request->user()->posts()->create(['image_url' => $url, 'content' => $request->content, 'restaurant_name' => $request->restaurant_name]);
        return view('posts.edit', ['post' => $post]);
    }
    
    public function show($id){
        $post = Post::find($id);
        
        return view('posts.show', ['post' => $post]);
    }
    
    public function edit($id){
        $post = Post::find($id);
        
        return view('posts.edit', ['post' => $post]);
    }
    
    public function update(Request $request, $id){
        $this->validate($request, ['image' => 'required', 'content' => 'required|max:191', 'restaurant_name' => 'required|max:191']);
        $post = Post::find($id);
        
        if($request->image != null){
            $file = $request->file('image1');
            $path = Storage::disk('s3')->putFile('avatar-folder', $file, 'public');
            $url = Storage::disk('s3')->url($path);
            $post->image_ur = $url;
        }
        if($request->content != null){
            $post->content = $request->content;
        }
        if($request->restaurant_name != null){
            $post->restaurant_name = $request->restaurant_name;
        }
        
        $post->save();
        return redirect()->back();
    }
}
