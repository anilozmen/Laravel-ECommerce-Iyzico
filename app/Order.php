<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";

    protected $guarded = [];

    public function baskets()
    {
        return $this->belongsTo('App\Basket', 'basket_id');
    }

}
