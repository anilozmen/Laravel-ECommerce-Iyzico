<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public function run()
    {

      
        $users = [
            ["name" => "Admin","surname" => "Admin","email" => "admin@admin.com","password" => bcrypt("admin")],
            ["name" => "User","surname" => "User","email" => "user@user.com","password" => bcrypt("user")],
        ];

        foreach($users as $user){
            User::create($user);
        }

        DB::table("role_user")->insert(["role_id" => 1, "user_id" => 1]);
        DB::table("role_user")->insert(["role_id" => 2, "user_id" => 1]);
        DB::table("role_user")->insert(["role_id" => 2, "user_id" => 2]);
    }
}
