<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('operators')->insert([
            ['name' => 'John Doe', 'employee_id' => 'EMP123', 'shift' => 'morning', 'assigned_line_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jane Smith', 'employee_id' => 'EMP456', 'shift' => 'evening', 'assigned_line_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
