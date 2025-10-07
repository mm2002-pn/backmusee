<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MainController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function page($numero)
    {
        if (View::exists('pages.' . $numero)) {
            return view('pages.' . $numero);
        } else {
            // Charge une vue d'erreur générique
            return view('errors.404');
        }
    }
}
