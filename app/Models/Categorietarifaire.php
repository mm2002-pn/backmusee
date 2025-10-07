<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorietarifaire extends Model
{
    use HasFactory;

    // categorietarifaireproduits

    public function categorietarifaireproduits(){
        return $this->hasMany(Categorietarifaireproduit::class);
    }




    // clients
    public function clients()
    {
        return $this->hasMany(Client::class, 'categorietarifaire_id');
    }
}
