<?php

namespace App;

use App\Article;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ArticleReport extends Model
{
    protected $table = 'article_reports';
    protected $fillable = ['title', 'description', 'id_article', 'id_user'];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_article');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
