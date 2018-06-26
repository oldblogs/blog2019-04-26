<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'css_class', 'email'];
}
