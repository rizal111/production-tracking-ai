<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['production_line_id', 'name', 'type', 'serial_number', 'status', 'capacity'];

    public function productionLine()
    {
        return $this->belongsTo(ProductionLine::class);
    }

    public function logs()
    {
        return $this->hasMany(ProductionLog::class);
    }
}
