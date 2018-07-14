<?php

use App\Images;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $images = array(
            array("name" => "1530922404.jpeg", "imageable_id" => 1, "imageable_type" => "App\Product"),
            array("name" => "227968.png", "imageable_id" => 1, "imageable_type" => "App\Product"),
            array("name" => "46158.png", "imageable_id" => 1, "imageable_type" => "App\Product"),
            array("name" => "1531055382.jpeg", "imageable_id" => 2, "imageable_type" => "App\Product"),
            array("name" => "191119.jpg", "imageable_id" => 2, "imageable_type" => "App\Product"),
            array("name" => "963249.jpg", "imageable_id" => 2, "imageable_type" => "App\Product"),
        );

        foreach ($images as $image)
        {
            Images::create($image);
        }
    }
}
