<?php

namespace App;

use App\Article;
use App\Subcategory;
use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    protected $table = 'master_categorys';
    protected $fillable = ['name', 'description'];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_category');
    }

    public function subcategory()
    {
        return $this->hasMany('App\Subcategory', 'id_category');
    }
}
