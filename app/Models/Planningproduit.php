<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planningproduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'planning_id',
        'produit_id',
    ];

    public function planning(){
        return $this->belongsTo(Planning::class);
    }

    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
