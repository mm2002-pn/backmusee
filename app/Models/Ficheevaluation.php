<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficheevaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee',
        'designation',
        'isactive',
    ];


    // Relations
    public function fichecriteres()
    {
        return $this->hasMany(Fichecritere::class);
    }

    // workflows
    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }
}
