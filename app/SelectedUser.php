<?php

namespace App;

use App\Article;
use App\User;
use App\Group;
use Illuminate\Database\Eloquent\Model;

class SelectedUser extends Model
{
    protected $table = 'selected_users';
    protected $fillable = [ 'id_article', 'id_user', 'id_group' ];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_article');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    
    public function group()
    {
        return $this->belongsTo('App\Group', 'id_group');
    }

}
