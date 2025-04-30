<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionLogsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $shifts = ['morning', 'evening', 'night'];
        $operators = [
            'morning' => [1 => 1, 2 => 5],
            'evening' => [1 => 4, 2 => 2],
            'night'   => [1 => 3, 2 => 6],
        ];
        $maxCapacity = [1 => 1200, 2 => 1000];

        $startDate = Carbon::create(2025, 5, 1);
        $endDate = Carbon::create(2025, 5, 31);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            foreach ($shifts as $shift) {
                foreach ([1, 2] as $machineId) {
                    $operatorId = $operators[$shift][$machineId];
                    $maxOutput = $maxCapacity[$machineId];
                    $isBigDowntime = rand(1, 100) <= 20;
                    $maxDowntime = $isBigDowntime ? 120 : 30;
                    $downtime = rand(1, 100) <= 20 ? rand($isBigDowntime ? 30 : 0, $maxDowntime) : 0;
                    $scrap = rand(1, 100) <= 20 ? rand(1, 50) : 0;
                    $maxactualOutput = $maxOutput  - $scrap - ($maxOutput / 420 * $downtime);
                    $actualOutput = rand((int)($maxactualOutput * 0.8), $maxactualOutput);
                    // Log::info('date: ' . $date->format('Y-m-d') . ', shift: ' . $shift . ', machine_id: ' . $machineId . ', downtime: ' . $downtime . ', operator_id: ' . $operatorId . ', Scrap: ' . $scrap . ', maxOutput: ' . $maxOutput - $scrap - ($maxOutput / 420 * $downtime) . ', units_produced: ' . $actualOutput);
                    DB::table('production_logs')->insert([
                        'log_date' => $date->format('Y-m-d'),
                        'shift' => $shift,
                        'machine_id' => $machineId,
                        'production_line_id' => $machineId,
                        'scrap_units' => $scrap,
                        'downtime' => $downtime,
                        'operator_id' => $operatorId,
                        'units_produced' => $actualOutput,
                    ]);
                }
            }
        }
    }
}
