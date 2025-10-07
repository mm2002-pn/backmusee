<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelEvolutionDemandeParMoisExport implements FromView
{
    use Exportable;

    private $data;
    // private $labels;

    public function __construct($data , $labels = null)
    {
        $this->data = $data;
        // $this->labels = $labels;
    }

    public function view(): View
    {
        $args = null;
        return view('excels.excelevolutiondemandemois' ,[
            // 'labels' => isset( $this->labels ) ?  $this->labels : null,
            'data' => isset( $this->data['data'] ) ?  $this->data['data'] : null,
            'filters' => isset( $this->data['filters'] ) ?  $this->data['filters'] : null,

        ]);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
}
