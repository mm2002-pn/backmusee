<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statutamm extends Model
{
    use HasFactory;

    protected $fillable = [
        'codeproduit',
        'designationsalama',
        'nomcommercial',
        'nomfournisseur',
        'fournisseur_id',
        'laboratoiretitulaire',
        'laboratoirefabriquant',
        'numeroamm',
        'datedelivranceamm',
        'dateexpirationamm',
        'statutenregistrement',
        'laboratoiretitulaire_id',
        'laboratoirefabriquant_id',
    ];



    // article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    // fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }


    // laboratoiretitulaire
    public function labotitulaire()
    {
        return $this->belongsTo(Fabricant::class, 'laboratoiretitulaire_id');
    }

    // laboratoirefabriquant
    public function labofabricant()
    {
        return $this->belongsTo(Fabricant::class, 'laboratoirefabriquant_id');
    }
}
