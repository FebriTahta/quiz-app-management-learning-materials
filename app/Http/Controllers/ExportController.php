<?php

namespace App\Http\Controllers;
use App\Exports\TemplateSiswaExport;
use App\Exports\TemplateGuruExport;
use App\Exports\TemplateQuizExport;
use App\Exports\TemplateMapelExport;
use App\Exports\TemplateExamurai;
use App\Exports\UserExport;
use App\Models\Kelas;
use App\Models\Siswa;
use Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function download_template_siswa($kelas_id)
    {
        return Excel::download(new TemplateSiswaExport($kelas_id),'template_siswa.xlsx',ExcelExcel::XLSX);
    }

    public function download_template_guru()
    {
        return Excel::download(new TemplateGuruExport(), 'template_guru.xlsx',ExcelExcel::XLSX);
    }

    public function download_template_quiz()
    {
        return Excel::download(new TemplateQuizExport(), 'template_quiz.xlsx',ExcelExcel::XLSX);
    }
    
    public function download_template_mapel()
    {
        return Excel::download(new TemplateMapelExport(), 'template_mapel.xlsx',ExcelExcel::XLSX);
    }

    public function download_template_examurai()
    {
        return Excel::download(new TemplateExamurai(), 'template_examurai.xlsx',ExcelExcel::XLSX);
    }

    public function download_user_kelas(Request $request)
    {
        $kelas = Kelas::findOrFail($request->id);
        
        return Excel::download(new UserExport($kelas), 'data_user_siswa_'.$kelas->angkatan->tingkat->tingkat_name.' '.$kelas->jurusan->jurusan_name.' '.$kelas->kelas_name.'.xlsx',ExcelExcel::XLSX);
    }
}
