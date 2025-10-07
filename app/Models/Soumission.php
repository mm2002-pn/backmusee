<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soumission extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'score',
        'statut',
        'isbc',
        'iscontrat',
        'ao_id',
        'fournisseur_id',
    ];






    // Relations
    public function ao()
    {
        return $this->belongsTo(Ao::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function soumissionarticles()
    {
        return $this->hasMany(Soumissionarticle::class);
    }
    // typeconditions
    public function typecondition()
    {
        return $this->belongsTo(Typecondition::class);
    }
}
