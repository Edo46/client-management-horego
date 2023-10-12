<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRestrictionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('restriction_access')->count() == 0){
            DB::table('restriction_access')->insert([
                [
                    'id' => 1,
                    'user_id' => 1,
                    'person' => 1,
                    'organisation' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
