<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CateProdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cateprods = array(
            array("category_id" => 1, "product_id" => 1),
            array("category_id" => 2, "product_id" => 2)
        );

        foreach ($cateprods as $cateprod)
        {
            DB::table('cateprod')->insert([$cateprod]);
        }
    }
}
