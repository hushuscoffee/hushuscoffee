<?php

namespace App;

use App\Comment;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{

    protected $table = 'comment_reports';
    protected $fillable = [ 'id_comment', 'id_user', 'title', 'description'];

    public function comment()
    {
        return $this->belongsTo('App\Comment', 'id_comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
