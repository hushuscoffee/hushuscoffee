<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes'; 
    protected $fillable = ['id_article', 'vote'];

    public function article()
    {
        $this->belongsTo('App\Article', 'id_article');
    }
}
