<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sociallink extends Model
{
    // Define allowed variables
    protected $fillable= ['order', 'user_id', 'title', 'csocial_id', 'link'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the csocial record.
     */
    public function csocial()
    {
        return $this->hasOne('App\Csocial');
    }

}
