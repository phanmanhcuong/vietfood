<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

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
        
        if($request->hasfile('image')){
            $file = $request->file('image');
            $name=time().$file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $user->avatar_url = $filePath;
        }
        $user->save();
        return redirect()->back();
    }
}
