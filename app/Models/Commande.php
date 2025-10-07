<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;


    //  client

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    //  typelivraison

    public function typelivraison()
    {
        return $this->belongsTo(Typelivraison::class);
    }


 

    // detailcommande
    public function detailcommandes()
    {
        return $this->hasMany(Detailcommande::class);
    }


    // campagne
    public function campagne()
    {
        return $this->belongsTo(Campagne::class);
    }
}
