<?php

namespace App;

use App\MasterCategory;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategorys';
    protected $fillable = ['name', 'id_category'];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_subcategory');
    }

    public function category()
    {
        return $this->belongsTo('App\MasterCategory', 'id_category');
    }
}
