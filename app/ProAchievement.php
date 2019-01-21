<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProAchievement extends Model
{
    protected $table = 'pro_achievements';
    protected $fillable = ['id_user', 'username', 'title', 'link', 'issuer', 'month', 'year', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
