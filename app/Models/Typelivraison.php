<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typelivraison extends Model
{
    use HasFactory;

    protected $table = 'typelivraisons';

    protected $fillable = ['designation', 'description'];



    // commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
