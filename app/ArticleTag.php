<?php

namespace App;

use App\Tags;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'articletags';
    protected $fillable = ['id_article', 'id_tag'];

    public function tag()
    {
        return $this->belongsTo('App\Tags', 'id_tag');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_article');
    }
}
