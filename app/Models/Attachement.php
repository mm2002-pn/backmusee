<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachement extends Model
{
    use HasFactory;


    // ao
    public function ao()
    {
        return $this->belongsTo(Ao::class);
    }



    // documentspecification_id
    public function documentspecification()
    {
        return $this->belongsTo(Documentspecification::class);
    }

}
