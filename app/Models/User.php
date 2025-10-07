<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'web';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'nom',
        'prenom',
        'code',
        'compteclient',
        'role_id', // Ajoutez ceci
        'profilable_type', // Pour la relation morphique
        'profilable_id' // Pour la relation morphique
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    public function hasRole($bool)
    {
        return $this->role->isadmin == $bool;
    }

    public function can($abilities, $arguments = [])
    {
        return $this->role->permissions->contains('name', $abilities);
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }



    public function profilable()
    {
        return $this->morphTo();
    }


    // equipegestionpers
    public function equipegestionpers()
    {
        return $this->hasMany(Equipegestionpersonnel::class);
    }
}
