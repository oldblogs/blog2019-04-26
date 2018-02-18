<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'body'];
    
    // Define restricted variables
    // protected $guarded = ['user_id'];
    
}
