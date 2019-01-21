<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
   
    protected $table = 'article_images'; 
    protected $fillable = ['image', 'id_article'];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_article'); 
    }
}
