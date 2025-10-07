<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentdao extends Model
{
    use HasFactory;

    public function da()
    {
        return $this->belongsTo(Da::class, 'da_id');
    }
}
