<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProExperience extends Model
{
    protected $table = 'pro_experiences';
    protected $fillable = ['id_user', 'username', 'title', 'link', 'company', 'position', 'location', 'monthf', 'yearf', 'montht', 'yeart', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
