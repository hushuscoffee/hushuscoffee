<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements'; 
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
