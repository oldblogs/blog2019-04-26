<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Csocial extends Model
{
    // Define allowed variables
    protected $fillable=[ 'order', 'title', 'css_class', 'homepage' ];
}
