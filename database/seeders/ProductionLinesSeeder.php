<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionLinesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('production_lines')->insert([
            ['name' => 'Line A', 'location' => 'Zone 1', 'status' => 'active'],
            ['name' => 'Line B', 'location' => 'Zone 2', 'status' => 'active'],
        ]);
    }
}
