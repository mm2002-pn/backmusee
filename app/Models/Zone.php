<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'descriptions',
        'antenne_id',
    ];



    public function planningzones()
    {
        return $this->hasMany(Planningzone::class);
    }

    public function pointdeventes()
    {
        return $this->hasMany(Pointdevente::class);
    }

    // antenne

    public function antenne()
    {
        return $this->belongsTo(Antenne::class);
    }


    // parent
    public function parent()
    {
        return $this->belongsTo(self::class);
    }


    // userzone
    public function userzones()
    {
        return $this->hasMany(Userzone::class);
    }
}
