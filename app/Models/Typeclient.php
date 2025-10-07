<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeclient extends Model
{
    use HasFactory;

    protected $table = 'typeclients';

    protected $fillable = [
        'designation',
        'description',
    ];




    //clienttypeclient
    public function clienttypeclients()
    {
        return $this->hasMany(Clienttypeclient::class);
    }
}
