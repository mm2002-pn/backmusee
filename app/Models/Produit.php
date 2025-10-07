<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;


    //planingproduit
    public function planningproduits()
    {
        return $this->hasMany(Planningproduit::class);
    }

    //detaillivraison
    public function detaillivraisons()
    {
        return $this->hasMany(Detaillivraison::class);
    }

    // categories
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // detailbls
    public function detailbls()
    {
        return $this->hasMany(Detailbl::class);
    }

    // categorietarifaireproduits

    public function categorietarifaireproduits()
    {
        return $this->hasMany(Categorietarifaireproduit::class);
    }

    


    // unite

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }
}
