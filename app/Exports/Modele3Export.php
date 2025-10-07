<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Modele3Export  implements FromView
{
    public function __construct($appelOffre)
    {
        $this->appelOffre = $appelOffre;
    }

    public function view(): View
    {
        return view('excels.modele3', [
            'appelOffre' => $this->appelOffre,
        ]);
    }
}
