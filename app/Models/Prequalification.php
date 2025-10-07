<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prequalification extends Model
{
    use HasFactory;

    protected $fillable = [
        'anneeprequalification',
        'anneeexpiration',
        'referenceaoip',
        'code',
        'type',          // enum (C, M, null)
        'denomination',
        'cdt',
        'fournisseur_id',
        'fabriquant',
        'adresse',
        'pays_id',
        'statut',
    ];

    // pays
    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }



    // fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }


    // fabricant
    public function fabricant()
    {
        return $this->belongsTo(Fabricant::class);
    }

    // article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
