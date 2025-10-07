<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typepointdevente extends Model
{
    use HasFactory;



    // pointdeventes

    public function pointdeventes()
    {
        return $this->hasMany(Pointdevente::class);
    }
}
