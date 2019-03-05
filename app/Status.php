<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
    protected $table = 'status';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function brewings()
    {
        return $this->hasMany('App\Brewing');
    }

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}
