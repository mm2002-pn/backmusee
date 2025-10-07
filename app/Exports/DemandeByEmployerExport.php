<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DemandeByEmployerExport implements FromView 
{
    use Exportable;

    private $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $args = null;

        return view('excels.exceldemandeemployer', [
            'data'                          =>isset($this->data['data'])                                   ?  $this->data['data']                              : null,
            'filters'                          =>isset($this->data['filters'])                                   ?  $this->data['filters']                              : null,
        ]);
    }
      
    /**
    * @return \Illuminate\Support\Collection
    */
}
