<?php

namespace App\Http\Controllers;

use App\Models\RefactoringItems\SaveModel;
use Illuminate\Http\Request;

class Notif extends SaveModel
{
    //
    public function notif_perm_users()
    {
        return $this->hasMany(NotifPermUser::class);
    }
}
