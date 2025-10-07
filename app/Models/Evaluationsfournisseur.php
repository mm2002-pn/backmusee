<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluationsfournisseur extends Model
{
    use HasFactory;



    // unite
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }


    public function noteevaluations()
    {
        return $this->hasMany(Noteevaluation::class);
    }
}
