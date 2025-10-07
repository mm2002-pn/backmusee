<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $table = 'roles';
    protected $fillable = [
        'name',
        'isadmin'
        // Autres propriétés fillable...
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_has_permissions',
            'role_id',
            'permission_id'
        );


    }


    // detailtypemarchedetails
    public function detailtypemarchedetails()
    {
        return $this->belongsToMany(
            Detailtypemarchedetail::class,
            'detailtypemarchedetails',
            'role_id',
            'typemarchedetail_id'
        );
    }


}
