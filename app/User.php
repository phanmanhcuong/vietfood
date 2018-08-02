<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_url', 'gentle', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function like_posts(){
        return $this->belongsToMany(Post::class, 'user_like', 'user_id', 'post_id')->withTimestamps();
    }
    
    public function like($postId){
        $exist = $this->is_like($postId);
        
        if ($exist){
            return false;
        } else{
            $this->like_posts()->attach($postId);
            return true;
        }
    }
    
    public function unlike($postId){
        $exist = $this->is_like($postId);
        
        if ($exist){
            $this->like_posts()->detach($postId);
            return true;
        } else{
            return false;
        }
    }
    
    public function is_like($postId){
        return $this->like_posts()->where('post_id', $postId)->exists();
    }
    
    public function comments(){
        return $this->hasMany(UserComment::class);
    }
}
