<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RefactoringItems\SaveModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NotifPermUser extends SaveModel
{
    //
    public function notif()
    {
        return $this->belongsTo(Notif::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
