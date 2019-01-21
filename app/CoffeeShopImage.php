<?php

use App\CoffeeShop;
namespace App;

use Illuminate\Database\Eloquent\Model;

class CoffeeShopImage extends Model
{
    protected $table = 'coffee_shop_images';
    protected $fillable = ['id_coffee_shop', 'image'];

    public function coffeeShop()
    {
        return $this->belongsTo('App\CoffeeShop', 'id_coffee_shop');
    }
}
