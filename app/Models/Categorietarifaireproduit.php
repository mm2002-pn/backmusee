<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorietarifaireproduit extends Model
{
    use HasFactory;
    protected $fillable  = [
        'produit_id',
        'categorietarifaire_id',
    ];

    // produit

    public function produit(){
        return $this->belongsTo(Produit::class);
    }

    // categorietarifaire

    public function categorietarifaire(){
        return $this->belongsTo(Categorietarifaire::class);
    }


    // unite

    public function unite(){
        return $this->belongsTo(Unite::class);
    }
}
