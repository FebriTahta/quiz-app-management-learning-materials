<?php

namespace App\Exports;
use App\Models\Kelas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class TemplateSiswaExport implements FromView
{
    public function __construct($kelas_id)
    {
        $this->kelas_id = $kelas_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $kelas = Kelas::where('id',$this->kelas_id)->with('angkatan','jurusan')->first();
        return view('export.template_siswa',compact('kelas'));
    }
}
