<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class MasterStatus extends Model
{
    protected $table = 'master_statuss';
    protected $fillable = ['name'];

    public function article()
    {
        return $this->belongsTo('App\Article', 'id_status');
    }
}
