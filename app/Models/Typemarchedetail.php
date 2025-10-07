<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typemarchedetail extends Model
{
    use HasFactory;

    //typemarche
    public function typemarche()
    {
        return $this->belongsTo(Typemarche::class, 'typemarche_id');
    }

    //parcourmarche
    public function parcourmarche()
    {
        return $this->belongsTo(Parcourmarche::class, 'parcourmarche_id');
    }

    // detailtypemarchedetails
    public function detailtypemarchedetails()
    {
        return $this->hasMany(Detailtypemarchedetail::class, 'typemarchedetail_id');
    }
}
