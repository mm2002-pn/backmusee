<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentspecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'typemarche_id',
        'etape',
        'etapetexte',
        'designation',
        'nature'
    ];

    // dadocumentspecification
    public function  dadocumentspecifications()
    {
        return $this->hasMany(Dadocumentspecification::class);
    }


    // typemarche
    public function typemarche()
    {
        return $this->belongsTo(Typemarche::class);
    }
}
