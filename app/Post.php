<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'image_url', 'title', 'content', 'restaurant_name'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
