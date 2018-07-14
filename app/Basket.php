<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Basket extends Model
{
    //

    protected $table = "baskets";

    protected $guarded = [];

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function basket_products()
    {
        return $this->hasMany('App\BasketProduct');
    }

    public static function active_basket_id()
    {
        $active_basket = DB::table('baskets as s')
            ->leftJoin('orders as si', 'si.basket_id', '=', 's.id')
            ->where('s.user_id', auth()->id())
            ->whereRaw('si.id is null')
            ->orderByDesc('s.created_at')
            ->select('s.id')
            ->first();

        if (!is_null($active_basket)) return $active_basket->id;
    }

    public function basket_product_qty()
    {
        return DB::table('basket_products')->where('basket_id', $this->id)->sum('quantity');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
