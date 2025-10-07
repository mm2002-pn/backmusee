<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typecondition extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
    ];
}
