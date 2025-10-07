<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'code',
        'typefournisseur_id',
        'categoriefournisseur_id',
        'adresse',
        'score',
        'annee',
        'TSSCOD_0_0'
    ];


    //unite
    public function categoriefournisseur()
    {
        return $this->belongsTo(Categoriefournisseur::class);
    }

    // type
    public function typefournisseur()
    {
        return $this->belongsTo(Typefournisseur::class, "typefournisseur_id");
    }

    // prequalifications
    public function prequalifications()
    {
        return $this->hasMany(Prequalification::class);
    }


    // evaluationsfournisseurs
    public function evaluationsfournisseurs()
    {
        return $this->hasMany(Evaluationsfournisseur::class);
    }

    // parkings
    public function parkings()
    {
        return $this->hasMany(Parking::class);
    }
}
