<?php

namespace App;

use App\Status;
use App\Shared;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use Sluggable;
    use SoftDeletes;
    protected $table = 'recipes';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function favourites()
    {
    	return $this->hasMany('App\Favourite');
    }

    public function shared()
    {
    	return $this->belongsTo('App\Shared');
    }

    public function status()
    {
    	return $this->belongsTo('App\Status');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
