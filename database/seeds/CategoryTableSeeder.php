<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = array(
            array("category_name" => "Shoes", "slug" => "shoes"),
            array("category_name" => "Bags", "slug" => "bags")
        );

        foreach ($categories as $category)
        {
            Category::create($category);
        }
    }
}
