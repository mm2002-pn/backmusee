<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailcommande extends Model
{
    use HasFactory;

    // commande
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    // article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
