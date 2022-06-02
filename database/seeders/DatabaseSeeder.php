<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\OfficesName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(DistricSeeder::class);
        // $this->call(CircleSeeder::class);
        // $this->call(DivisionSeeder::class);
        // $this->call(RangeSeeder::class);
        // $this->call(OfficesNameSeeder::class);
        // $this->call(ActivityList::class);
        $this->call(AdminLoginSeeder::class);
    }
}
