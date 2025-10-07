<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;



    // detailmaterial
    public function detailmateriels()
    {
        return $this->hasMany(Detailmateriel::class);
    }


    // commercial
    public function commercial()
    {
        return $this->belongsTo(User::class);
    }

    // pointdevente
    public function pointdevente()
    {
        return $this->belongsTo(Pointdevente::class);
    }

   
}
