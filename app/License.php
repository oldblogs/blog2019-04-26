<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable= [
        'spdx', 'lic_name', 'lic_deed', 'legal', 'fsf', 'osi'
    ];

    public function medium(){
        return $this->hasMany(Medium::class);
    }

}
