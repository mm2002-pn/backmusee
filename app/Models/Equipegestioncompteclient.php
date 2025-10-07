<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipegestioncompteclient extends Model
{
    use HasFactory;

    // client
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    // client
    public function equipegestion()
    {
        return $this->belongsTo(Equipegestion::class, 'equipegestion_id');
    }
}
