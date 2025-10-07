<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipegestionclient extends Model
{
    use HasFactory;

    // client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    // client
    public function equipegestion()
    {
        return $this->belongsTo(Equipegestion::class, 'equipegestion_id');
    }
}
