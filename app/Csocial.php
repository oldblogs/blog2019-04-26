<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Csocial extends Model
{
    // Define allowed variables
    protected $fillable=[ 'title', 'css_class', 'homepage' ];

}

