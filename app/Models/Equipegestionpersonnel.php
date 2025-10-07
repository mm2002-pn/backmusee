<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipegestionpersonnel extends Model
{
    use HasFactory;




    // equipegestion
    public function equipegestion()
    {
        return $this->belongsTo(Equipegestion::class, 'equipegestion_id');
    }

    // personnel
    public function personnel()
    {
        return $this->belongsTo(User::class, 'personnel_id');
    }
}
