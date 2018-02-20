<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'body'];
    
    // Define restricted variables
    // Dont return request()->all() with 
    //     protected $guarded = [] 
    //     ( ignores validation )
    // protected $guarded = ['user_id'];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
