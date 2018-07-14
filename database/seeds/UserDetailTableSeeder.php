<?php

use App\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $usersDetails = [
            ["user_id" => 1,"address" => "ADMIN ADDRESS","phone" => 12345,"m_phone" => 12345,"city" => "ADMIN CITY","country" => "ADMIN COUNTRY","zipcode" => 12345],
        ["user_id" => 2,"address" => "USER ADDRESS","phone" => 1234,"m_phone" => 1234,"city" => "USER CITY","country" => "USER COUNTRY","zipcode" => 1234],
        ];

        foreach($usersDetails as $userDetail){
            UserDetail::create($userDetail);
        }

    }
}
