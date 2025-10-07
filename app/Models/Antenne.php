<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antenne extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'code',
        
    ];



  

    // zone one to many avec antenne

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }


    // historiqueaffectation
    public function historiqueaffectations()
    {
        return $this->hasMany(Historiqueaffectation::class);
    }
}
