<?php

namespace App\Exports;
use App\Models\Kelas;
use App\Models\Soalmulti;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class TemplateUjianExport implements FromView
{
    public function __construct($number_soal)
    {
        $this->number_soal = $number_soal;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $arr_code = array();
        for ($i=1; $i <= $this->number_soal ; $i++) { 
            $code = bin2hex(random_bytes(5));
            if (in_array($code, $arr_code) && Soalmulti::where('soal_kode', '=', $code)->count() > 0) {
                $i--;
                // array_push($arr_code, 'pernah sama di '.$i.' value nya '.$code);
            }
            else {
                array_push($arr_code, $code);
            }
        }
        // dd($arr_code);
        
        return view('export.template_ujian',[
            'codes' => $arr_code
        ]);
    }
}
