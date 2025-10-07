<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;



    public function planningzones()
    {
        return $this->hasMany(Planningzone::class);
    }



    public function users()
    {
        return $this->belongsToMany(User::class, 'planningusers', 'planning_id', 'user_id');
    }

    // planningusers
    public function planningusers()
    {
        return $this->hasMany(Planninguser::class);
    }


    public function  voiture()
    {
        return $this->belongsTo(Voiture::class);
    }

    //planningproduit
    public function planningproduits()
    {
        return $this->hasMany(Planningproduit::class);
    }
    // planningequipements
    public function planningequipements()
    {
        return $this->hasMany(Planningequipement::class);
    }


    //visite
    public function visites()
    {
        return $this->hasMany(Visite::class);
    }
}
