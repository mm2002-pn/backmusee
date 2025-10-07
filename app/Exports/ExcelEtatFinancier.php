<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelEtatFinancier implements FromView, WithTitle
{
    private $soumissions;

    public function __construct($soumissions = [])
    {
        $this->soumissions = $soumissions;
    }

    public function view(): View
    {
        return view('excels.etatfinancier', [
            'soumissions' => $this->soumissions,
            'appelOffreReference' => 'AO-REF-' . date('Y'),
            'articleDesignation' => 'Article Principal'
        ]);
    }

    public function title(): string
    {
        return 'État Financier';
    }
}