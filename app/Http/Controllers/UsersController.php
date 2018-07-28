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
}
