<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Illuminate\Support\Str;

class PilganKelasExport implements FromView, ShouldAutoSize
{
    public function __construct($jawaban)
    {
        $this->jawaban = $jawaban;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('export.pilgan_kelas_export',[
            'jawaban'=> $this->jawaban
        ]);
    }
}
