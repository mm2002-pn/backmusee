<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userzone extends Model
{
    use HasFactory;


    protected $table = 'userzones';

    protected $fillable = ['user_id', 'zone_id', 'date'];


    // user
    public function user(){
        return $this->belongsTo(User::class);
    }


    // zone
    public function zone(){
        return $this->belongsTo(Zone::class);
    }

}
