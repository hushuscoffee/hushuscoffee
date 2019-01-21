<?php

namespace App;

use App\MasterStatus;
use App\MasterShared;
use App\MasterCategory;
use App\Vote;
use App\ArticleImage;
use App\SelectedUser;
use App\User;
use App\Subcategory;
use App\Comment;
use App\ArticleTag;
use App\Tag;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Article extends Model
{
    use Sluggable;
    protected $table = 'articles';
    protected $fillable = ['id_status', 'id_shared', 'id_category','id_subcategory', 'id_user','title', 'description', 'file', 'comment_count', 'upvote_count', 'downvote_count'];

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

    public function status()
    {
        return $this->hasOne('App\MasterStatus', 'id_status');
    }

    public function shared()
    {
        return $this->hasOne('App\MasterShared', 'id_shared');
    }

    public function category()
    {
        return $this->hasOne('App\MasterCategory', 'id_category');
    }

    public function vote()
    {
        return $this->hasMany('App\Vote', 'id_vote');
    }

    public function articleImage()
    {
        return $this->hasMany('App\ArticleImage', 'id_article');
    }

    public function articleReport()
    {
        return $this->hasMany('App\ArticleImage', 'id_article');
    }

    public function selectedUser()
    {
        return $this->hasMany('App\SelectedUser', 'id_article');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'id_user');
    }

    public function subcategory()
    {
        return $this->hasOne('App\Subcategory', 'id_subcategory');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag', 'articletags', 'id_article', 'id_tag');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment', 'id_article');
    }

    public function favorite()
    {
    	return $this->hasMany('App\Favourite', 'id_article');
    }
}
