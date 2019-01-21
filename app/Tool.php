<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table = 'tools';
    protected $fillable = ['nama', 'jumlah', 'satuan', 'id_article'];

}
