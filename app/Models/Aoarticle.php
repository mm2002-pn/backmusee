<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aoarticle extends Model
{
    use HasFactory;



    public function ao()
    {
        return $this->belongsTo(Ao::class);
    }


    // article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
