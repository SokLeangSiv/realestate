<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\facades\Hash;
use Illuminate\support\facades\DB;

class userseedertable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([

        ["name"=>"Admin",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("3333"),
            "role" =>"admin",
            "status" => "active"
        ],
        

        //agent

        ["name"=>"Agent",
            "username" => "agent",
            "email" => "agent@gmail.com",
            "password" => Hash::make("1234"),
            "role" =>"agent",
            "status" => "active"
        ],

        //user
        [
        "name"=>"User",
            "username" => "user",
            "email" => "user@gmail.com",
            "password" => Hash::make("5555"),
            "role" =>"user",
            "status" => "active"
        ]
        
        ]);
    }
}
