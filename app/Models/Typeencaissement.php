<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeencaissement extends Model
{
    use HasFactory;


    //encaissement
    public function encaissements(){
        return $this->hasMany(Encaissement::class);
    }
}
