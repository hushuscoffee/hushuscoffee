<?php

namespace App;

use App\Article;
use App\ArticleReport;
use App\CoffeeShop;
use App\Comment;
use App\CommentReport;
use App\Favourite;
use App\Group;
use App\GroupMember;
use App\Job;
use App\SelectedUser;
use App\Role;
use App\ProAchievement;
use App\ProExperience;
use App\ProLanguage;
use App\ProSkill;
use App\ProProfile;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // use Notifiable;
    protected $table = 'user_auths'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_role', 'email', 'username', 'password'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function article()
    {
        return $this->hasMany('App\Article', 'id_user');
    }

    public function articleReport()
    {
        return $this->hasMany('App\ArticleReport', 'id_user');
    }

    public function coffeeShop()
    {
        return $this->hasMany('App\CoffeeShop', 'id_user');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'id_user');
    }

    public function commentReport()
    {
        return $this->hasMany('App\CommentReport', 'id_user');
    }

    public function favourite()
    {
        return $this->hasMany('App\Favourite', 'id_user');
    }

    public function group()
    {
        return $this->hasMany('App\Group', 'id_user');
    }

    public function groupMember()
    {
        return $this->hasMany('App\GroupMember', 'id_user');
    }

    public function job()
    {
        return $this->hasMany('App\Job', 'id_user');
    }

    public function selectedUser()
    {
        return $this->hasMany('App\SelectedUser', 'id_user');
    }

    public function profile()
    {
        return $this->hasMany('App\Profile', 'id_user');
    }

    public function achievement()
    {
        return $this->hasMany('App\ProAchievement', 'id_user');
    }

    public function skill()
    {
        return $this->hasMany('App\ProSkill', 'id_user');
    }

    public function experience()
    {
        return $this->hasMany('App\ProExperience', 'id_user');
    }

    public function language()
    {
        return $this->hasMany('App\ProLanguage', 'id_user');
    }

    public function role()
    {
        return $this->hasOne('App\Role', 'id_role');
    }
}
