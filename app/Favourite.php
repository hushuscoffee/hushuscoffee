<?php

namespace App;

use App\User;
use App\Article;
use App\Brewing;
use App\Recipe;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourites'; 
    
    public function articles()
    {
        return $this->belongsTo('App\Article');
    }

    public function brewings()
    {
        return $this->belongsTo('App\Brewing');
    }

    public function recipes()
    {
        return $this->belongsTo('App\Recipe');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
