<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromCollection;

class Modele2Export implements FromView
{
    private $appelOffre;

    public function __construct($appelOffre)
    {
        $this->appelOffre = $appelOffre;
    }

    public function view(): View
    {
        return view('excels.modele2', [
            'appelOffre' => $this->appelOffre,
        ]);
    }
}
