<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bailleur extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->morphOne(User::class, 'profilable');
    }


    // bailleurprogramme
    public function bailleurprogrammes()
    {
        return $this->hasMany(Bailleurprogramme::class);
    }
}
