<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DemandeAbsenceExport implements FromView
{

    use Exportable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $args = null;
        return view('excels.exceldemandeabsence' ,[
            'data' => isset( $this->data['data'] ) ?  $this->data['data'] : null,
            'typedemandes' => isset( $this->data['typedemandes'] ) ?  $this->data['typedemandes'] : null,
            'filters' => isset( $this->data['filters'] ) ?  $this->data['filters'] : null,
        ]);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    
}
