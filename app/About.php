<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class About extends Model
{
    // Define allowed variables
    protected $fillable= ['user_id', 'title', 'subtitle', 'body', 'photo'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

}
