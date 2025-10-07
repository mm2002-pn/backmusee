<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;


class Modele1Export  implements FromView
{
    public function __construct($appelOffre)
    {
        $this->appelOffre = $appelOffre;
    }

    public function view(): View
    {
        return view('excels.modele1', [
            'appelOffre' => $this->appelOffre,
        ]);
    }
}
