<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('users')->count() == 0){
            DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'Admin',
                    'email' => 'admin@mail.com',
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'password' => bcrypt('password123'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
