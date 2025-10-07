<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soumissionarticle extends Model
{
    use HasFactory;


    protected $fillable = [
        'soumission_id',
        'article_id',
        'quantite',
        'prix_unitaire',
        'typecondition_id',
        'fabricant_id',
        'pays_id',
        'prixunitairepropose',
        'prequalification',
        'prixunitaireconvention',
        'statutamm',
        'dateprequalification',
        'observationsaq',
        'resultatevaluation',
        'presencedossierstech',
        'presenceechantillon',
        'coeff',
        'targetprice',
        'quantitedemande',
        'quantitepropose'
    ];

    // Relations
    public function soumission()
    {
        return $this->belongsTo(Soumission::class, 'soumission_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function typecondition()
    {
        return $this->belongsTo(Typecondition::class);
    }

    // fabricant
    public function fabricant()
    {
        return $this->belongsTo(Fabricant::class);
    }


    // pays
    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}
