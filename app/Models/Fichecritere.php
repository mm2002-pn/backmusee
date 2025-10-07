<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichecritere extends Model
{
    use HasFactory;

    protected $fillable = [
        'ficheevaluation_id',
        'critere_id',
        'ponderation',
        'ordre',
    ];




    // Relations
    public function ficheevaluation()
    {
        return $this->belongsTo(Ficheevaluation::class);
    }

    public function critere()
    {
        return $this->belongsTo(Critere::class);
    }

    public function noteevaluations()
    {
        return $this->hasMany(Noteevaluation::class);
    }
}
