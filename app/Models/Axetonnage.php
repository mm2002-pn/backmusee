<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Axetonnage extends Model
{
    use HasFactory;




    // axe
    public function axe()
    {
        return $this->belongsTo(Axe::class, 'axe_id');
    }

    // tonnage
    public function tonnage()
    {
        return $this->belongsTo(Tonnage::class, 'tonnage_id');
    }
}
