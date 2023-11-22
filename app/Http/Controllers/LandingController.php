<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\TemplateSiswaExport;
use App\Exports\TemplateUjianExport;
use Maatwebsite\Excel\Excel as ExcelExcel;

class LandingController extends Controller
{
    public function home_lms()
    {
        $siswa = auth()->user()->siswa;
        $cek_  = Siswa::where('user_id', auth()->user()->id)->first();
        if (empty($cek_)) {
            $data = [
                'user_id' => auth()->user()->id,
                'kelas_id' => null,
                'angkatan_id' => null,
                'siswa_nik' => auth()->user()->pass,
                'siswa_name' => auth()->user()->username,
                'siswa_slug' => Str::slug(auth()->user()->username),
                'siswa_status' => 'non_aktif'
            ];
            Siswa::create($data);
        }
        return view('fe_page.landing',compact('siswa'));
    }

    public function home_lms_guru()
    {
        $guru = Guru::where('user_id',auth()->user()->id)->first();
        return view('fe_page.landing_guru',compact('guru'));
    }

    public function download_template_ujian($number_soal)
    {
        // dd($number_soal);
        return Excel::download(new TemplateUjianExport($number_soal),'template_ujian.xlsx',ExcelExcel::XLSX);
    }

    public function submit_missing_data(Request $request)
    {
        $siswa = Siswa::findOrFail(auth()->user()->siswa->id);

        $siswa->update([
            'kelas_id' => $request->kelas_id,
            'angkatan_id' => $request->angkatan_id
        ]);

        return redirect()->back()->with('success','berhasil memperbarui data');
    }
}
