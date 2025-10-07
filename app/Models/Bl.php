<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bl extends Model
{
    use HasFactory;




    // commercial

    public function commercial()
    {
        return $this->belongsTo(User::class, "commercial_id");
    }


    // detailbls

    public function detailbls()
    {
        return $this->hasMany(Detailbl::class);
    }
}
