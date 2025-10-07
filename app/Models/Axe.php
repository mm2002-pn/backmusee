<?php

namespace App\Models;

use App\Http\Controllers\AxeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Axe extends Model
{
    use HasFactory;

    // categorieclient
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }


    // axe
    public function axetonnages()
    {
        return $this->hasMany(Axetonnage::class, 'axe_id');
    }


}
