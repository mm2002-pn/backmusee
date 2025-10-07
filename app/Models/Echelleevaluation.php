<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echelleevaluation extends Model
{
    use HasFactory;
    protected $fillable = ['critere_id', 'min', 'max', 'designation', 'ordre','points'];



    // critere
    public function critere()
    {
        return $this->belongsTo(Critere::class);
    }
}
