<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';

    protected $fillable = [
        'designation',
        'prix',
        'quantite',
        'description',
        'image',
        'categorie_id',
        'code'
    ];




    //unite
    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

    // categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // lignecommande
    public function lignecommandes()
    {
        return $this->hasMany(Lignecommande::class);
    }


    // articleremisedureedevies
    public function articleremisedureedevies()
    {
        return $this->hasMany(Articleremisedureedevie::class);
    }


    public function remiseApplicable($moismin, $moismax)
    {
        // Si pas de typeduree fourni → on prend celui de l'article
        $typeduree = $this->COURTEDUREE_0 ?? 0;

        // Règle de base : une remise qui couvre l'intervalle
        $regle = Remisedureedevie::where('typeduree', $typeduree)
            ->where('moinsnim', '<=', $moismin)
            ->where('moismax', '>=', $moismax)
            ->first();

        if (!$regle) {
            return null;
        }

        // Vérifier si une exception spécifique existe pour cet article
        $remiseSpecifique = Articleremisedureedevie::where('article_id', $this->id)
            ->where('remisedureedevie_id', $regle->id)
            ->first();

        // ✅ Retourner une valeur numérique
        if ($remiseSpecifique) {
            return $remiseSpecifique->remisepourcentage ?? $remiseSpecifique->remisevaleur ?? 0;
        }

        return $regle->remisepourcentage ?? $regle->remisevaleur ?? 0;
        return $remiseSpecifique ?? $regle->remisepourcentage ?? $regle->remisevaleur ?? 0;
    }


    // prequalifications
    public function prequalifications()
    {
        return $this->hasMany(Prequalification::class);
    }

    // last prequalification
    public function lastprequalification()
    {
        // relation hasOne qui pointe vers la plus récente Prequalification
        return $this->hasOne(Prequalification::class)->latestOfMany();
    }
    // laststatutamm
    public function laststatutamm()
    {
        return $this->hasOne(Statutamm::class, 'codeproduit', 'code')->latestOfMany();
    }
}
