<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasRoles, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function publish(Post $post)
    {
        $this->posts()->save($post);
    }

    public function update_post(Post $post)
    {
        $post->save();
    }

    public function deletePost(Post $post)
    {
        $post->delete();
    }

    public function socialids(){
        return $this->hasMany(Socialid::class);
    }
    
    public function saveSocialid(Socialid $token){
        $this->socialids()->save($token);
    }

    public function deleteSocialid(Socialid $token){
        $token->delete();
    }

}
