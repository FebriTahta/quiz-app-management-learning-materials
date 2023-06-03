<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Exports\TemplateSiswaExport;
use App\Exports\TemplateUjianExport;
use Maatwebsite\Excel\Excel as ExcelExcel;

class LandingController extends Controller
{
    public function home_lms()
    {
        $siswa = auth()->user()->siswa;
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
}
