<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachinesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('machines')->insert([
            ['production_line_id' => 1, 'name' => 'Cutter 01', 'type' => 'Cutter', 'serial_number' => 'SN-00123', 'status' => 'operational', 'created_at' => now(), 'updated_at' => now()],
            ['production_line_id' => 2, 'name' => 'Packer 01', 'type' => 'Packer', 'serial_number' => 'SN-00456', 'status' => 'downtime', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
