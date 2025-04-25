<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionLine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'status'];

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }

    public function operators()
    {
        return $this->hasMany(Operator::class, 'assigned_line_id');
    }

    public function productionLogs()
    {
        return $this->hasMany(ProductionLog::class);
    }
}
