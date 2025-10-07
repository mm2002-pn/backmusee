<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aofournisseur extends Model
{
    use HasFactory;




    // ao
    public function ao()
    {
        return $this->belongsTo(Ao::class);
    }


    // fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
