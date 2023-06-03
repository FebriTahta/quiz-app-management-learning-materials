<?php
namespace App\Exports;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromView
{
    public function __construct($kelas)
    {
        $this->kelas = $kelas;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $siswa = Siswa::where('kelas_id', $this->kelas->id)->get();
        return view('export.data_user_siswa',[
            'siswa' => $siswa, 'kelas'=> $this->kelas
        ]);
    }
}
