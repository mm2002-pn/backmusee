<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daevenement extends Model
{
    use HasFactory;

    protected $table = 'daevenements';


    protected $fillable = ['da_id', 'designation', 'date'];



    // da
    public function da()
    {
        return $this->belongsTo(Da::class);
    }
}
