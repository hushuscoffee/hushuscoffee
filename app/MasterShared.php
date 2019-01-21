<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class MasterShared extends Model
{
    protected $table = 'master_shareds';
    protected $fillable = ['name'];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_shared');
    }
}
