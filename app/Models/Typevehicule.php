<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typevehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'description',
    ];




    // vehicules
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
}
