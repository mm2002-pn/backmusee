<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonepointdevente extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'pointdevente_id',
    ];



}
