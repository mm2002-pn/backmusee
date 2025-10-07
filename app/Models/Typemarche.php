<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typemarche extends Model
{
    use HasFactory;

    public function typemarchedetails()
    {
        return $this->hasMany(Typemarchedetail::class, 'typemarche_id');
    }




    // ao
    public function aos()
    {
        return $this->hasMany(Ao::class, 'typemarche_id');
    }

    // documentspecification

    public function documentspecifications()
    {
        return $this->hasMany(Documentspecification::class, 'typemarche_id');
    }
}
