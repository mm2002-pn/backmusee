<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encaissement extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'visite_id',
        'typeencaissement_id',
        'montantaregle',
        'montantrecouvrement',
        'montantreglement',
        'numfacture',
        'isreglement',
        'montantrecuperer',
    ];


    //typeencaissement
    public function typeencaissement()
    {
        return $this->belongsTo(Typeencaissement::class);
    }

    //visite
    public function visite()
    {
        return $this->belongsTo(Visite::class);
    }
}
