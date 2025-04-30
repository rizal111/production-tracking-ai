<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use App\Models\Machine;
use App\Models\Operator;
use App\Models\ProductionLog;

class DatabaseController extends Controller
{
    public function Page()
    {
        return Inertia::render('database', [
            "production_logs" => ProductionLog::orderBy('log_date', 'desc')->get(),
            'operators' => Operator::all(),
            'machines' => Machine::all(),
        ]);
    }
}
