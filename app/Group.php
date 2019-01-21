<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['id_user', 'name', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
