<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    use HasFactory;

    protected $fillable = ['designation', 'description', 'points'];



    // critere
    public function echelleevaluations()
    {
        return $this->hasMany(Echelleevaluation::class);
    }


    // Relations
    public function fichecriteres()
    {
        return $this->hasMany(Fichecritere::class);
    }

    
}
