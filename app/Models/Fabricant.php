<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricant extends Model
{
    use HasFactory;

    //unite
    public function pay()
    {
        return $this->belongsTo(Pays::class, 'pay_id');
    }


    // soumissionarticle
    public function soumissionarticles()
    {
        return $this->hasMany(Soumissionarticle::class);
    }

    // prequalifications
    public function prequalifications()
    {
        return $this->hasMany(Prequalification::class);
    }
}
