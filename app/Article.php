<?php

namespace App;

use App\Status;
use App\Shared;
use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Article extends Model
{
    use Sluggable;
    protected $table = 'articles';

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

    public function category()
    {
    	return $this->belongsTo('App\Category');
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
