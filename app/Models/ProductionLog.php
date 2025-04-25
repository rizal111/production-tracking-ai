<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_line_id',
        'machine_id',
        'operator_id',
        'shift',
        'units_produced',
        'scrap_units',
        'downtime',
        'log_date',
        'notes'
    ];

    public function line()
    {
        return $this->belongsTo(ProductionLine::class, 'production_line_id');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function aiInsights()
    {
        return $this->morphMany(AiInsight::class, 'related', 'related_model', 'related_id');
    }
}
