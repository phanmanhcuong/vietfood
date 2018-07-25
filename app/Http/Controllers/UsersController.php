<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function showProfile($id){
        $user = User::find($id);
        
        return view('users.showProfile', ['user' => $user,]);
    }
}
