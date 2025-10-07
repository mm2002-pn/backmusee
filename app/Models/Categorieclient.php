<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorieclient extends Model
{
    use HasFactory;

    protected $table = 'categorieclients';

    protected $fillable = [
        'designation',
        'description',
    ];




    // clients
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
