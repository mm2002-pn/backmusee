<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    use HasFactory;



    
    // lignecommande
    public function lignecommandes()
    {
        return $this->hasMany(Lignecommande::class);
    }



    // phasedepots
    public function phasedepots()
    {
        return $this->hasMany(Phasedepot::class);
    }

    // programme
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }


    // commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
