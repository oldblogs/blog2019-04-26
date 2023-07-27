<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $fillable= [
        'enabled','file', 'external_url', 'stock_url', 'stock_desc'
    ];

    public function medium_type(){
      return $this->belongsTo( MediumType::class );
    }

    public function license(){
      return $this->belongsTo( License::class );
    }

}
