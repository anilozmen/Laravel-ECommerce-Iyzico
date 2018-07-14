<?php

use Illuminate\Database\Seeder;
use App\Basket;

class BasketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $baskets = [
        	[
        		"id" => 1, 
        		"user_id" => 1
        	],
        	[
        		"id" => 2, 
        		"user_id" => 2,
        	]
        ];

         foreach($baskets as $basket){
            Basket::create($basket);
        }

    }
}
