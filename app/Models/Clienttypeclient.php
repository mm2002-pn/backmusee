<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clienttypeclient extends Model
{
    use HasFactory;



    // client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    // clienttype
    public function typeclient()
    {
        return $this->belongsTo(Typeclient::class);
    }

    //
}
