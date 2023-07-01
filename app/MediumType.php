<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MediumType extends Model
{
    protected $fillable= [
        'mtype', 'msubtype', 'mclass'
    ];

    public function medium(){
        return $this->hasMany(Medium::class);
    }
}


