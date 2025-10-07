<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsda extends Model
{
    use HasFactory;

    public function da()
    {
        return $this->belongsTo(Da::class, 'da_id');
    }
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
    public function unite()
    {
        return $this->belongsTo(Unite::class, 'unite_id');
    }
}
