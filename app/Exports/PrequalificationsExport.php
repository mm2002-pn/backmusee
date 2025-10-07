<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class PrequalificationsExport implements FromView
{
    public function __construct($prequalification)
    {
        $this->prequalification = $prequalification;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        // dd($this->prequalification[0]);
        return view('excels.prequalifications', [
            'prequalifications' => $this->prequalification,
        ]);
    }
}
