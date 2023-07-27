<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'subtitle', 'body', 'photo'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

}
