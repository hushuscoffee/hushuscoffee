<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    // use Notifiable;
    use SoftDeletes;
    protected $table = 'users'; 

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function brewings()
    {
        return $this->hasMany('App\Brewing');
    }

    public function favourites()
    {
    	return $this->hasMany('App\Favourite');
    }

    public function profile()
    {
    	return $this->hasOne('App\Profile');
    }

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }

    public function role()
    {
    	return $this->belongsTo('App\Role');
    }
    
}
