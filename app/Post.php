<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    // Define allowed variables
    protected $fillable= ['user_id', 'title', 'body'];
    
    // Define restricted variables
    // Dont return request()->all() with 
    //     protected $guarded = [] 
    //     ( ignores validation )
    // protected $guarded = ['user_id'];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function addComment($body)
    {
        $this->comments()->create( compact('body') );
    }
    
    public function scopeFilter($query, $filters){
        if(isset($filters) && $filters){
            // TODO: User input Validation 
            if ( $month = $filters['month'] ){
                $query->whereMonth('created_at', Carbon::parse($month)->month );
            }
            
            // TODO: User input Validation 
            if ( $year = $filters['year'] ){
                $query->whereYear('created_at', $year);
            }
        }
    } // public function scopeFilter
    
    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
