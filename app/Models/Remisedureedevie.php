<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remisedureedevie extends Model
{
    use HasFactory;

    protected $table = 'remisedureedevies';


    protected $fillable = ['typeduree', 'moinsnim', 'moismax', 'remisepourcentage', 'remisevaleur'];




    // article
    public function articleremisedureedevies()
    {
        return $this->hasMany(Articleremisedureedevie::class);
    }
}
