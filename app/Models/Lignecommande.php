<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignecommande extends Model
{
    use HasFactory;


    // produit
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    // campagne

    public function campagne()
    {
        return $this->belongsTo(Campagne::class);
    }

    // programme 

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }
}
