<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typefournisseur extends Model
{
    use HasFactory;
     protected $fillable = [
        'designation',
    ];


    // fournisseurs
    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class);
    }
}
