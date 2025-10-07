<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planningequipement extends Model
{
    use HasFactory;


    public function planning(){
        return $this->belongsTo(Planning::class);
    }

    public function equipement(){
        return $this->belongsTo(Equipement::class);
    }
}
