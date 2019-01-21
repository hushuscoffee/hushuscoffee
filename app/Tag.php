<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    public function article_tag()
    {
        return $this->belongsToMany('App\Article', 'articletags', 'id_article', 'id_tag');
    }
}
