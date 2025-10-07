<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planningzone extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'planning_id',
        'zone_id',
        'created_at',
        'updated_at',
    ];

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
