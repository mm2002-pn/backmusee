<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noteevaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'fichecritere_id',
        'evaluationsfournisseur_id',
        'note',
    ];



    public function fichecritere()
    {
        return $this->belongsTo(Fichecritere::class);
    }

    public function evaluationsfournisseur()
    {
        return $this->belongsTo(Evaluationsfournisseur::class);
    }
}
