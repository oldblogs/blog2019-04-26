<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class Sociallink extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'csocial_id', 'link'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the csocial record.
     */
    public function csocial()
    {
        return $this->belongsTo('App\Csocial');
    }

    /**
     * Returns social links that belong to the logged in user.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSelf($query) {
        return $query->where('user_id', auth()->user()->id );
    }
    
}
