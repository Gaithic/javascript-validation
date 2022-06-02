<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'designation'  => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Netgen@789'),
            'office_id' => null,
            'district_id' => null,
            'circle_id' => null,
            'division_id' => null,
            'range_id' => null,
            'date_of_birth' => '',
            'date_of_join' => '',
            'office_address' => '',
            'gender' => '',
            'qualification' => '',
            'username' => 'admin',
            'contact'=> '',
            'isAdmin'=> 1,
            'status' => 1

        ]);

    }
}
