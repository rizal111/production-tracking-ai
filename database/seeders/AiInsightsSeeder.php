<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AiInsightsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('ai_insights')->insert([
            [
                'related_model' => 'production_logs',
                'related_id' => 1,
                'insight_type' => 'efficiency_tip',
                'message' => 'Consider reducing break overlap by 10 mins for better shift output.',
                'generated_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'related_model' => 'machines',
                'related_id' => 2,
                'insight_type' => 'anomaly',
                'message' => 'Machine Packer 01 has shown repeated downtimes. Suggest pre-emptive maintenance.',
                'generated_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
