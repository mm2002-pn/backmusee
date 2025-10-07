<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = [
        'typevehicule_id',
        'matricule',
        'marque',
        'tonnage_id',
        'description',
        'volume',
        'estinterne'
    ];


    // type de vehicule
    public function typevehicule()
    {
        return $this->belongsTo(Typevehicule::class);
    }

    // tonnage
    public function tonnage()
    {
        return $this->belongsTo(Tonnage::class, 'tonnage_id');
    }

    // parkings
    public function parkings()
    {
        return $this->hasMany(Parking::class);
    }

    // chauffeur
    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }
}

