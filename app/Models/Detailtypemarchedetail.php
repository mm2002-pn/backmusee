<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailtypemarchedetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'role_id',
        'typemarchedetail_id',
    ];



    // typemarchedetails
    public function typemarchedetail()
    {
        return $this->belongsTo(Typemarchedetail::class, 'typemarchedetail_id');
    }

    // roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
