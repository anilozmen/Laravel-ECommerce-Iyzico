<?php

use Illuminate\Database\Seeder;
use App\BasketProduct;

class BasketProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $basketProducts = [
        	[
        		"id" => 1, 
        		"basket_id" => 1,
        		"product_id" => 1,
        		"quantity" => 12,
        		"price" => 100,
        		"status" => "Your order has been received"
        	],
        	[
        		"id" => 2, 
        		"basket_id" => 2,
        		"product_id" => 1,
        		"quantity" => 23,
        		"price" => 100,
        		"status" => "Your order has been received"
        	]
        ];

        foreach($basketProducts as $basketProduct){
            BasketProduct::create($basketProduct);
        }


    }
}
