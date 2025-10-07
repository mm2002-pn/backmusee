<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StatutammsExport implements FromView
{

    public function __construct($statutamm)
    {
        $this->statutamm = $statutamm;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        // dd($this->statutamm[0]);
        return view('excels.statutamm', [
            'statutamm' => $this->statutamm,
        ]);
    }
}
