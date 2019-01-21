<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProSkill extends Model
{
    protected $table = 'pro_skills';
    protected $fillable = ['id_user', 'username', 'skill', 'proficiency'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
