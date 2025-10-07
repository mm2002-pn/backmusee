<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;


    // lignecommande
    public function lignecommandes()
    {
        return $this->hasMany(Lignecommande::class);
    }



    // bailleurprogramme
    public function bailleurprogrammes()
    {
        return $this->hasMany(Bailleurprogramme::class);
    }

    // equipegestion
    public function equipegestion()
    {
        return $this->belongsTo(Equipegestion::class);
    }

  
    // campagnes
    public function campagnes()
    {
        return $this->hasMany(Campagne::class);
    }

    
}
