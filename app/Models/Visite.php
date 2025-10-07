<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;


    

    public function commercial()
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }

    public function pointdevente()
    {
        return $this->belongsTo(Pointdevente::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }


    //detailmateriel
    public function detailmateriels()
    {
        return $this->hasMany(Detailmateriel::class);
    }

    //detaillivraison
    public function detaillivraisons()
    {
        return $this->hasMany(Detaillivraison::class);
    }

    //encaissements
    public function encaissements()
    {
        return $this->hasMany(Encaissement::class);
    }


    // modepaiement

    public function modepaiement()
    {
        return $this->belongsTo(Modepaiement::class);
    }
    
}
