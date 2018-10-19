<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    // Define allowed variables
    protected $fillable= ['title', 'email'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Return emails that belong to the logged in user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSelf($query) {
        return $query->where('user_id', auth()->user()->id );
    }

}

