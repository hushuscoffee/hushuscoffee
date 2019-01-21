<?php

namespace App;

use App\User;
use App\CoffeeShopImage;
use Illuminate\Database\Eloquent\Model;

class CoffeeShop extends Model
{
    protected $table = 'coffee_shops';
    protected $fillable = ['id_user', 'name', 'address', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function coffeeShopImage()
    {
        return $this->hasMany('App\CoffeeShopImage', 'id_coffee_shop');
    }
}
