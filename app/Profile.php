<?php

namespace App;

use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles'; 
    protected $fillable = [
        'id_user', 
        'username', 
        'fullname',
        'gender', 
        'birthday', 
        'phone', 
        'profession', 
        'photo', 
        'city', 
        'sociallinks', 
        'portfoliolinks', 
        'address', 
        'aboutme'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'id_user');
    }

    public function article()
    {
        return $this->hasMany('App\Article', 'id_user');
    }

}
