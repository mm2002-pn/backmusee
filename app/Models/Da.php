<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Da extends Model
{
    use HasFactory;
    protected $table = 'das';

    protected $casts = [
        'YTYPEPASS_0' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Typemarche()
    {
        return $this->belongsTo(Typemarche::class, 'typemarche_id');
    }
    public function demandeur()
    {
        return $this->belongsTo(User::class, 'demandeur_id');
    }
    public function preparateur()
    {
        return $this->belongsTo(User::class, 'preparateur_id');
    }

    // dadocumentspecification
    public function dadocumentspecifications()
    {
        return $this->hasMany(Dadocumentspecification::class);
    }

    // daevenement
    public function daevenements()
    {
        return $this->hasMany(Daevenement::class);
    }
}
