<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'steps';
    protected $fillable = ['description', 'file', 'id_article'];

}
