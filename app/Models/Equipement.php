<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;



    //detailmateriel
    public function detailmateriels(){
        return $this->hasMany(Detailmateriel::class);
    }
}
