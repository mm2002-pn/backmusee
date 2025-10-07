<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailbl extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'total',
        'produit_id',
        'bl_id',
        'pointdevente_id',
    ];
    // bl

    public function bl()
    {
        return $this->belongsTo(Bl::class);
    }

    // produit

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // pointdevente

    public function pointdevente()
    {
        return $this->belongsTo(Pointdevente::class);
    }
}
