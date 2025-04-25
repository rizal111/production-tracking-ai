<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operator extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'employee_id', 'shift', 'assigned_line_id'];

    public function assignedLine()
    {
        return $this->belongsTo(ProductionLine::class, 'assigned_line_id');
    }

    public function logs()
    {
        return $this->hasMany(ProductionLog::class);
    }
}
