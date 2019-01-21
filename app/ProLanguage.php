<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProLanguage extends Model
{
    protected $table = 'pro_languages';
    protected $fillable = ['id_user', 'username', 'language', 'proficiency'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
