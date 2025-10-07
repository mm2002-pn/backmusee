<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;




    // detaillivraisons

    public function detaillivraisons()
    {
        return $this->hasMany(Detaillivraison::class);
    }








    //produits

    public function articles()
    {
        return $this->hasMany(Article::class);
    }



    // categorietarifaireproduits

    public function categorietarifaireproduits()
    {
        return $this->hasMany(Categorietarifaireproduit::class);
    }


    // tonnages

    public function tonnages()
    {
        return $this->hasMany(Tonnage::class);
    }
}
