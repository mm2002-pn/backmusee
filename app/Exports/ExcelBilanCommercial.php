<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ExcelBilanCommercial implements FromView
{
    use Exportable;

    private $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        //dd($this->data);
        return view('excels.excelbilanfiche', [
            'data' => isset($this->data) ? $this->data : null,
        ]);
    }
}
