<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = "clients";

    protected $fillable = ['designation', 'telfixe', 'telmobile', 'region', 'district', 'categorieclient'];


    public function user()
    {
        return $this->morphOne(User::class, 'profilable');
    }


    // categorieclient
    public function categorieclient()
    {
        return $this->belongsTo(Categorieclient::class);
    }
    public function axe()
    {
        return $this->belongsTo(Axe::class);
    }


    // clienttypeclients
    public function clienttypeclients()
    {
        return $this->hasMany(Clienttypeclient::class);
    }

    // commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }


    
}
