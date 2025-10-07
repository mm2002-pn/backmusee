<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiqueaffectation extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "antenne_id",
        "date",
    ];



    // user

    public function  user ()
    {
        return $this->belongsTo(User::class);
    }


    // antenne
    public function antenne(){
        return $this->belongsTo(Antenne::class);
    }
    


}
