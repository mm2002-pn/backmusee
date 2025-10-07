<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailmateriel extends Model
{
    use HasFactory;
    protected $fillable = ['equipement_id', 'type', 'quantite', 'visite_id', 'demande_id', 'est_activer'];

    //viste
    public function visite(){
        return $this->belongsTo(Visite::class);
    }

    //equipement
    public function equipement(){
        return $this->belongsTo(Equipement::class);
    }

    //demandes
    public function demande(){
        return $this->belongsTo(Demande::class);
    }
    
}
