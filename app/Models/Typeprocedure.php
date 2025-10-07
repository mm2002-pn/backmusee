<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeprocedure extends Model
{
    use HasFactory;
     protected $fillable = [
        'designation',
    ];




    // ao
    public function aos()
    {
        return $this->hasMany(Ao::class, 'typeprocedure_id');
    }
}
