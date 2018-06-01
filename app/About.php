<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class About extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'subtitle', 'body', 'photo'];
    
    

}
