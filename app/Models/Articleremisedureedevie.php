<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articleremisedureedevie extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'remisedureedevie_id',
        'date',
        'remisevaleur',
        'remisepourcentage',
        'created_at',
        'updated_at',
    ];


    // article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    // remisedureedevie
    public function remisedureedevie()
    {
        return $this->belongsTo(Remisedureedevie::class);
    }
}
