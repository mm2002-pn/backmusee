<?php

namespace App\Models;

use App\Models\RefactoringItems\SaveModelController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;


    // fournisseur_id
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    // vehicule_id
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
