<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapelmaster;
use App\Models\Jawabanmulti;
use App\Models\Ujian;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Vids;
use DataTables;
use Crypt;
use Validator;
use App\Models\Jawabtugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelajaranController extends Controller
{
    public function mapel_mapelmaster($mapelmaster_id)
    {
        $mapelmaster_id = Crypt::decrypt($mapelmaster_id);
        $mapelmaster = Mapelmaster::where('id',$mapelmaster_id)->with(['materi','mapel'])->withcount('mapel','docs', 'vids', 'ujian', 'materi','tugas','docstugas')->first();
        $guru_id = Guru::where('user_id', '=', auth()->user()->id)->first();
        $tugas = Tugas::where('mapelmaster_id', $mapelmaster_id)->get();
        return view('fe_page.detail_mapel', [
            'mapelmaster' => $mapelmaster,
            'tugas' => $tugas,
            'mapelmaster_id' => $mapelmaster_id,
            'kelas_id' => $mapelmaster->kelas_id,
            'mapel' => $mapelmaster->mapel,
        ]);
    }

    public function mapel_mapelmaster_siswa($mapelmaster_id)
    {
        $mapelmaster_id = Crypt::decrypt($mapelmaster_id);
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $mapelmaster = Mapelmaster::where('id',$mapelmaster_id)->with('materi')->withcount('docs', 'vids', 'ujian', 'materi')->first();
        $ujian = Ujian::where('mapelmaster_id', $mapelmaster_id)->get();
        $tugas = Tugas::where('mapelmaster_id', $mapelmaster_id)->get();
        $nilai = [];
        $nama_ujian = [];
        foreach ($ujian as $key => $value) {
            # code...
            $jawabanku = Jawabanmulti::where('ujian_id', $value->id)->where('siswa_id', auth()->user()->siswa->id)->sum('jawabanku');
            if ($jawabanku > 0) {
                # code...
                $nilai[] = round(($jawabanku / Jawabanmulti::where('ujian_id', $value->id)->where('siswa_id', auth()->user()->siswa->id)->count()) * 100);
            }else {
                # code..
                $nilai[] = 0;
            }
             
            $nama_ujian[] = $value->ujian_name;
        }
        return view('fe_page.detail_mapel_siswa', [
            'mapelmaster' => $mapelmaster,
            'siswa_id' => $siswa->id,
            'nilai_quiz' => $nilai,
            'nama_quiz' => $nama_ujian,
            'tugas' => $tugas,
            'mapelmaster_id' => $mapelmaster_id,
            'kelas_id' => $mapelmaster->kelas_id
        ]);
    }

    public function add_tugas_siswa(Request $request)
    {

        // dd($request);

        $validator = Validator::make($request->all(), [
            'tugas_name'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        } else {
            # code...
            $data = Tugas::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'mapelmaster_id' => $request->mapelmaster_id,
                    'guru_id' => $request->guru_id,
                    'kelas_id' => $request->kelas_id,
                    'uploader_nip' => $request->uploader_nip,
                    'tugas_name' => $request->tugas_name,
                    'tugas_desc' => $request->tugas_desc
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Tugas baru ditambahkan'
            ]);
        }
    }

    public function cek_nilai_siswa($kelas_id, $mapelmaster_id, $ujian_id)
    {
        $mapelmaster = Mapelmaster::where('id', $mapelmaster_id)->first();
        $ada_jawaban = Jawabanmulti::where('mapelmaster_id',$mapelmaster_id)
        ->where('ujian_id', $ujian_id)->first();
        if ($ada_jawaban != null) {
            # code...
            $data = Siswa::where('kelas_id', $kelas_id)->get();
            return DataTables::of($data)
            ->addColumn('nilai',function($data) use($kelas_id,$mapelmaster_id,$ujian_id){
                $jawaban = Jawabanmulti::where('siswa_id', $data->id)->where('mapelmaster_id',$mapelmaster_id)
                                       ->where('ujian_id', $ujian_id)->sum('jawabanku');
                $nilai   = ($jawaban / Jawabanmulti::where('siswa_id', $data->id)->where('mapelmaster_id',$mapelmaster_id)
                ->where('ujian_id', $ujian_id)->count())*100;
                return round($nilai);
            })
            ->rawColumns(['nilai'])
            ->make(true);
        }else {
            # code...
            return response()->json(
                ['status'=>400,'message'=>'belum ada jawaban']
            );
        }
            
    }

    public function cek_siswa($kelas_id)
    {
        $data = Siswa::where('kelas_id', $kelas_id)->get();
            return DataTables::of($data)
            ->addColumn('profile',function($data){
                return '<div class="course__member-thumb d-flex align-items-center">
                <img src="fe_assets/assets/img/course/instructor/course-instructor-1.jpg" alt="">
                </div>';
            })
            ->rawColumns(['profile'])
            ->make(true);
    }
}
