<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phasedepot extends Model
{
    use HasFactory;

    protected $table = 'phasedepots';



    // campagne
    public function campagne()
    {
        return $this->belongsTo(Campagne::class);
    }
}
