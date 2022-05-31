<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_lists')->insert([
            'id' => 1,
            'name' => 'Office',
            

        ]);

        DB::table('activity_lists')->insert([
            'id' => 2,
            'name' => 'PMU',
            

        ]);
    }
}
