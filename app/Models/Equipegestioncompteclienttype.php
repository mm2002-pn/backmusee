<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipegestioncompteclienttype extends Model
{
    use HasFactory;

    // client
    public function typeclient()
    {
        return $this->belongsTo(Typeclient::class, 'typeclient_id');
    }
    // client
    public function equipegestioncompteclient()
    {
        return $this->belongsTo(Equipegestioncompteclient::class, 'equipegestioncompteclient_id');
    }
}
