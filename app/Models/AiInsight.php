<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AiInsight extends Model
{
    use HasFactory;

    protected $fillable = ['related_model', 'related_id', 'insight_type', 'message', 'generated_at'];

    public function related()
    {
        return $this->morphTo(null, 'related_model', 'related_id');
    }
}
