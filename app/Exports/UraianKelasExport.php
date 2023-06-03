<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Str;
class UraianKelasExport implements FromView
,WithDrawings
{
    public function __construct($jawaban)
    {
        $this->jawaban = $jawaban;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function drawings()
    {
            $image = [];
            $i = 7;
            foreach ($this->jawaban as $key => $item) {
                //     # code...
                //     if (Str::limit($item->soalexamurai->soalexam_name, 3) == 'be_...')
                    if (!!$item && Str::limit($item->soalexamurai->soalexam_name, 3) == 'be_...') {
                        # code...
                        // $ke = $key;
                        $image[$key] = new Drawing();
                        $image[$key]->setName('soal');
                        $image[$key]->setDescription('soal');
                        // $drawing.$key->setPath(public_path('/be_assets/exam/exam_fffa81df-a25e-473a-8434-7cc0ab07d550.png'));
                        $image[$key]->setPath(public_path($item->soalexamurai->soalexam_name));
                        $image[$key]->setHeight(90);
                        $image[$key]->setCoordinates('D'.$i+$key);
                    }            
                }
                
                return $image;
    }

    public function view(): View
    {
        return view('export.uraian_kelas_export',[
            'jawaban'=> $this->jawaban
        ]);
    }
}
