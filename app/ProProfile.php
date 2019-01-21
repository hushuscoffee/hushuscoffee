<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProProfile extends Model
{
    protected $table = 'pro_profiles';
    protected $fillable = ['id_user', 'username', 'city', 'job', 'linkedin', 'resume', 'summary'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
