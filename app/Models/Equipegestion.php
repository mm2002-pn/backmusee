<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipegestion extends Model
{
    use HasFactory;

    protected $table = 'equipegestions';

    protected $fillable = [
        'designation',
        'description',
    ];



    // equipegestionpersonnel
    public function equipegestionpersonnels()
    {
        return $this->hasMany(Equipegestionpersonnel::class);
    }

    // personnels

    public function personnels()
    {
        return $this->belongsToMany(User::class, 'equipegestionpersonnels', 'equipegestion_id', 'personnel_id');
    }

    // programmes
    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }
}
