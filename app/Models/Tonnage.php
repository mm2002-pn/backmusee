<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tonnage extends Model
{
    use HasFactory;

    protected $guarded = [];

protected $fillable = [
    'designation',
    'unite_id',
    'tonnage'
];



    // unite
    public function unite(){
        return $this->belongsTo(Unite::class);
    }

    // axetonnages
    public function axetonnages(){
        return $this->hasMany(Axetonnage::class);
    }

    // vehicules
    public function vehicules(){
        return $this->hasMany(Vehicule::class);
    }
}
