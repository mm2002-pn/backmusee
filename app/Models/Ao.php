<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ao extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'statut',
        'date',
        'reference',
        'typemarche_id',
        'typeprocedure_id',
        'datepublication',
        'isnotationadministrative',
        'isnotationarticle',
        'isnotationfournisseur',
        'urlnotationfournisseur',
        'urlnotationarticle',
        'urlnotationadministrative',
    ];



    // typemarche
    public function typemarche()
    {
        return $this->belongsTo(Typemarche::class);
    }

    // Da
    public function da()
    {
        return $this->belongsTo(Da::class);
    }

    // typeprocedure
    public function typeprocedure()
    {
        return $this->belongsTo(Typeprocedure::class);
    }

    // aoarticles
    public function aoarticles()
    {
        return $this->hasMany(Aoarticle::class);
    }

    // aofournisseurs
    public function aofournisseurs()
    {
        return $this->hasMany(Aofournisseur::class);
    }


    // SOUMISSIONS
    public function soumissions()
    {
        return $this->hasMany(Soumission::class);
    }


    // attachments
    public function attachments()
    {
        return $this->hasMany(Attachement::class);
    }
}
