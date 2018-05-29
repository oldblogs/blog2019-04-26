<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialprovider extends Model
{
    public function socialids(){
        return $this->hasMany(Socialid::class);
    }
}
