<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bailleurprogramme extends Model
{
    use HasFactory;




    // programme
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    // bailleur
    public function bailleur()
    {
        return $this->belongsTo(Bailleur::class);
    }
}
