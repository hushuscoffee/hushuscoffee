<?php

namespace App;

use App\User;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourites';
    protected $fillable =[ 'id_user', 'id_article'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_article');
    }
}
