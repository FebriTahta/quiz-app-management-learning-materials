<?php

namespace App\Http\Controllers;
use App\Models\Tugas;
use App\Models\Docstugas;
use App\Models\Jawabtugas;
use Validator;
use File;
use Response;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function post_tugas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tugas_name'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            $data = Tugas::updateOrCreate(
                [
                    'id'=> $request->id,
                ],
                [
                    'mapelmaster_id'=> $request->mapelmaster_id,
                    'guru_id' => $request->guru_id,
                    'kelas_id' => $request->kelas_id,
                    'uploader_nip' => $request->uploader_nip,
                    'tugas_name' => $request->tugas_name,
                    'tugs_desc' => $request->tugas_desc,
                ]
            );

            return response()->json([
                'status'=> 200,
                'message' => 'Materi baru ditambahkan'
            ]);
        }
    }

    public function post_docstugas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapelmaster_id'  => 'required',
            'tugas_id'        => 'required',
            'docs_file'       => 'required|mimes:pdf,docx,csv,xlsx,ppt,pptx,rar',
            'docs_name'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 200,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            if($request->hasFile('docs_file')) {
                # code...
                if ($request->id !== null) {
                    # code...
                    $exist = Docstugas::findOrFail($request->id);
                    if ($exist) {
                        # code...
                        if(File::exists(public_path('docstugas_files/'.$exist->docs_files)))
                        {
                            File::delete(public_path('docstugas_files/'.$exist->docs_files));
                        }
                    }
                }

                $filename    = time().'_'.$request->docs_file->getClientOriginalName();
                $request->file('docs_file')->move('docstugas_files/',$filename);

                $data = Docstugas::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'tugas_id' => $request->tugas_id,
                        'docs_file' => $filename,
                        'docs_name' => $request->docs_name,
                    ]
                );
            }else {
                # code...
                $data = Docs::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'tugas_id' => $request->tugas_id,
                        'docs_name' => $request->docs_name,
                    ]
                );
            }

            return response()->json([
                'status' => 200,
                'message' => 'Dokumen barhasil ditambahkan ke Tugas terkait'
            ]);
        }
    }

    public function download_docstugas($docstugas_id)
    {
        $docs = Docstugas::findOrFail($docstugas_id);
        $filepath = public_path('docstugas_files/'.$docs->docs_file);
        return Response::download($filepath); 
    }

    public function download_tugasku($jawabtugas_id)
    {
        $docs = Jawabtugas::findOrFail($jawabtugas_id);
        $filepath = public_path('jawabtugas_file/'.$docs->jawabtugas_file);
        return Response::download($filepath); 
    }

    public function remove_docstugas(Request $request)
    {
        $data = Docstugas::findOrFail($request->id);
        if(File::exists(public_path('docstugas_files/'.$data->docs_files)))
        {
            File::delete(public_path('docstugas_files/'.$data->docs_files));
            $data->delete();
        }else {
            # code...
            $data->delete();
        }
        return response()->json([
            'status'=>200,
            'message'=> ' dokumen tugas telah dihapus'
        ]);
    }

    public function cek_tugas_siswa($mapelmaster_id,$tugas_id)
    {
        $data = Jawabtugas::where('mapelmaster_id', $mapelmaster_id)
        ->where('tugas_id', $tugas_id)->with('siswa')->get();
        return DataTables::of($data)
        ->addColumn('siswa',function($data){
            return $data->siswa->siswa_name;
        })
        ->addColumn('unduh',function($data){
            $unduh = '<a href="/download-jawaban-tugas-siswa/'.$data->id.'"><i class="fa fa-download"></i></a>';
            return $unduh;
        })
        ->addColumn('tanggal',function($data){
            return Carbon::parse($data->updated_at)->format("m/d/Y H:i");
        })
        ->rawColumns(['siswa','unduh','tanggal'])
        ->make(true);
    }

    public function post_jawab_tugas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapelmaster_id'  => 'required',
            'tugas_id'        => 'required',
            'siswa_id'        => 'required',
            'guru_id'         => 'required',
            'jawabtugas_file'       => 'required|mimes:pdf,docx,csv,xlsx',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 200,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            if($request->hasFile('jawabtugas_file')) {
                # code...
                if ($request->id !== null) {
                    # code...
                    $exist = Jawabtugas::findOrFail($request->id);
                    if ($exist) {
                        # code...
                        if(File::exists(public_path('jawabtugas_file/'.$exist->docs_files)))
                        {
                            File::delete(public_path('jawabtugas_file/'.$exist->docs_files));
                        }
                    }
                }

                $filename    = time().'_'.$request->jawabtugas_file->getClientOriginalName();
                $request->file('jawabtugas_file')->move('jawabtugas_file/',$filename);

                $data = Jawabtugas::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'tugas_id' => $request->tugas_id,
                        'siswa_id'=> $request->siswa_id,
                        'guru_id'=> $request->guru_id,
                        'jawabtugas_file' => $filename,
                        'jawabtugas_name' => $filename,
                    ]
                );
            }else {
                # code...
                $data = Jawabtugas::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'tugas_id' => $request->tugas_id,
                        'siswa_id'=> $request->siswa_id,
                        'guru_id'=> $request->guru_id,
                    ]
                );
            }

            return response()->json([
                'status' => 200,
                'message' => 'Jawaban barhasil ditambahkan ke Tugas terkait'
            ]);
        }
    }

    public function post_jawab_tugas2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapelmaster_id'  => 'required',
            'tugas_id'        => 'required',
            'siswa_id'        => 'required',
            'guru_id'         => 'required',
            'jawabtugas_file'       => 'required|mimes:pdf,docx,csv,xlsx',
            'jawabtugas_id'   => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 200,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            if($request->hasFile('jawabtugas_file')) {
                # code...
                if ($request->jawabtugas_id !== null) {
                    # code...
                    $exist = Jawabtugas::findOrFail($request->jawabtugas_id);
                    if ($exist) {
                        # code...
                        if(File::exists(public_path('jawabtugas_file/'.$exist->jawabtugas_file)))
                        {
                            File::delete(public_path('jawabtugas_file/'.$exist->jawabtugas_file));
                        }
                    }
                }

                $filename    = time().'_'.$request->jawabtugas_file->getClientOriginalName();
                $request->file('jawabtugas_file')->move('jawabtugas_file/',$filename);

                $data = Jawabtugas::updateOrCreate(
                    [
                        'id' => $request->jawabtugas_id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'tugas_id' => $request->tugas_id,
                        'siswa_id'=> $request->siswa_id,
                        'guru_id'=> $request->guru_id,
                        'jawabtugas_file' => $filename,
                        'jawabtugas_name' => $filename,
                    ]
                );
            }else {
                # code...
                $data = Jawabtugas::updateOrCreate(
                    [
                        'id' => $request->jawabtugas_id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'tugas_id' => $request->tugas_id,
                        'siswa_id'=> $request->siswa_id,
                        'guru_id'=> $request->guru_id,
                    ]
                );
            }

            return response()->json([
                'status' => 200,
                'message' => 'Jawaban barhasil ditambahkan ke Tugas terkait'
            ]);
        }
    }
}
