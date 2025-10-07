<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detaillivraison extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'quantite',
        'produit_id',
        'visite_id',
        'created_at',
        'updated_at'
    ];

    //visite
    public function visite()
    {
        return $this->belongsTo(Visite::class);
    }

    //produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    // unite

    public function unite()
    {
        return $this->belongsTo(Unite::class, 'unite_id');
    }
}
