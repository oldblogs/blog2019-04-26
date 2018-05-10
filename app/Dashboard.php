<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    // Define allowed variables
    protected $fillable= ['component', 'enabled'];

}
