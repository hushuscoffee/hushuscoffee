<?php

namespace App;

use App\Group;
use App\User;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_members';
    protected $fillable = ['id_group', 'id_user'];

    public function group()
    {
        return $this->belongsTo('App\Group', 'id_group');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
