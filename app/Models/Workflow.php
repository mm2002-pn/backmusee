<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'ficheevaluation_id',
        'role_id',
        'position',
    ];


    // ficheevaluation
    public function ficheevaluation()
    {
        return $this->belongsTo(Ficheevaluation::class);
    }

    // role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
