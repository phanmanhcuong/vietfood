<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'image_url', 'content', 'restaurant_name'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
