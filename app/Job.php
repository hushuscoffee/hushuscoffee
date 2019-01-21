<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = ['id_user', 'name', 'description', ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
