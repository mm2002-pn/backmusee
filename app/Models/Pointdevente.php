<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointdevente extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'client_id',
        'zone_id',
        'numbcpttier',
        'adresse',
        'telephone',
        'images',
        'latitude',
        'longitude',
        'gps',
        'intitule',
        'typepointdevente_id',
        'categoriepointdevente_id',
        'clef',
    ];



    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function visites()
    {
        return $this->hasMany(Visite::class);
    }


    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }


    public function detailbls()
    {
        return $this->hasMany(Detailbl::class);
    }



    public function typepointdevente()
    {
        return $this->belongsTo(Typepointdevente::class);
    }

    public function categoriepointdevente()
    {
        return $this->belongsTo(Categoriepointdevente::class);
    }
}
