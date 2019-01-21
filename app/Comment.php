<?php

namespace App;

use App\User;
use App\Article;
use App\Profile;
use App\CommentReport;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [ 'id_user', 'id_article', 'text'];

    public function user()
    {
        return $this->belongsTo('App\Profile', 'id_user');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function commentReport()
    {
        return $this->hasMany('App\CommentReport', 'id_comment');
    }

}
