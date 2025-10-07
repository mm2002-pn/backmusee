<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dadocumentspecification extends Model
{
    use HasFactory;

    // da
    public function da()
    {
        return $this->belongsTo(Da::class);
    }

    // documentspecification
    public function documentspecification()
    {
        return $this->belongsTo(Documentspecification::class);
    }
}
