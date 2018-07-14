<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserDetailTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(BasketTableSeeder::class);
        $this->call(BasketProductsTableSeeder::class);
        $this->call(OrderTableSeeder::class);
    }
}
