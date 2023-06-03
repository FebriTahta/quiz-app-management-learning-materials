<?php

namespace App\Http\Controllers;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Mapelmaster;
use App\Models\Angkatan;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Jawabtugas;
use App\Models\Ujian;
use App\Models\Materi;
use App\Models\Komenvideo;
use App\Models\Jawabanmulti;
use App\Models\Docstugas;
use App\Models\Doc;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;

class JurusanController extends Controller
{

    public function admin_jurusan(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Jurusan::with('kelas')->withCount('kelas')->get();
            return DataTables::of($data)
            ->addColumn('total_kelas',function($data){
                return number_format($data->kelas_count).' - kelas';
            })
            ->addColumn('opsi', function($data){
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel2"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-jurusan_name="'.$data->jurusan_name.'"
                data-toggle="modal" data-target="#modaledit2"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            })
            ->rawColumns(['total_kelas','opsi'])
            ->make(true);

        }
        return view('be_page.jurusan');
    }

    public function post_jurusan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'jurusan_name' => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()
            ]);
        }else {
            # code...
            $exist = Jurusan::where('jurusan_name', $request->jurusan_name)->first();
            if ($exist) {
                # code...
                if ($exist->id == $request->id) {
                    # code...
                    $data = Jurusan::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'jurusan_name' => $request->jurusan_name,
                            'jurusan_slug' => Str::slug($request->jurusan_name)
                        ]
                    );

                    return response()->json([
                        'status' => 200,
                        'message' => 'jurusan berhasil ditambahakan'
                    ]);
                }else {
                    # code...
                    return response()->json([
                        'status'=> 400,
                        'message' => ['terdapat jurusan dengan nama yang sama']
                    ]);
                }
            }else {
                # code...
                $data = Jurusan::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'jurusan_name' => $request->jurusan_name,
                        'jurusan_slug' => Str::slug($request->jurusan_name)
                    ]
                );

                return response()->json([
                    'status' => 200,
                    'message' => 'jurusan berhasil ditambahkan'
                ]);
            }
        }
    }







    public function daftar_copas(Request $request)
    {
        // $datax = Kelas::where('id',$id)->first();
        // $data  = $datax->mapel;
        // return DataTables::of($data)
        // ->addColumn('check', function ($data) {
        //     return '<input type="checkbox" class="sub_chk3" data-id="'.$data->id.'">';
        // })
        // ->rawColumns(['check'])
        // ->make(true);

        $data = Kelas::with(['jurusan','angkatan','mapel'])->withCount('siswa','mapel','guru')->orderBy('jurusan_id')->get();
            return DataTables::of($data)
            ->addColumn('check', function ($data) {
                return '<input type="checkbox" class="sub_chk4" data-id="'.$data->id.'">';
            })
            ->addColumn('angkatan_kelas', function($data) {
                return $data->angkatan->angkatan_name. ' - '.$data->angkatan->tingkat->tingkat_name;
            })
            ->addColumn('kelas_jurusan', function($data) {
                return $data->jurusan->jurusan_name.' '.$data->kelas_name;
            })
            ->rawColumns(['kelas_jurusan','angkatan_kelas','check'])
            ->make(true);
    }



    public function admin_jurusan_kelas_page(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Kelas::with(['jurusan','angkatan','mapel'])->withCount('siswa','mapel','guru')->orderBy('jurusan_id')->get();
            return DataTables::of($data)
            ->addColumn('angkatan_kelas', function($data) {
                return $data->angkatan->angkatan_name. ' - '.$data->angkatan->tingkat->tingkat_name;
            })
            ->addColumn('kelas_jurusan', function($data) {
                return $data->jurusan->jurusan_name.' '.$data->kelas_name;
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-jurusan_name="'.$data->jurusan->jurusan_name.'"
                data-kelas_name="'.$data->kelas_name.'" data-jurusan_id="'.$data->jurusan_id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            })
            ->addColumn('guru_kelas', function($data){
                $total_guru = Mapelmaster::where('kelas_id', $data->id)->count();
                return '<a href="#" data-toggle="modal" data-target="#manageguru" data-id="'.$data->id.'">'.$total_guru.' - guru</a>';
            })
            ->addColumn('mapel', function($data){
                if ($data->mapel_count > 0) {
                    # code...
                    return '<a href="#" data-toggle="modal" data-target="#manmapel"
                    data-id="'.$data->id.'">'.$data->mapel_count.' - mapel</a>';
                }else {
                    # code...
                    return '<a href="#" data-toggle="modal" data-target="#manmapel"
                    data-id="'.$data->id.'">'.$data->mapel_count.' - mapel</a>';
                }
            })
            ->addColumn('siswa', function($data){
                return'<a href="#" data-toggle="modal" data-target="#modalsiswa" data-id="'.$data->id.'">'.number_format($data->siswa_count).' - siswa</a>';
            })
            ->rawColumns(['kelas_jurusan','opsi','siswa','angkatan_kelas','mapel','guru_kelas'])
            ->make(true);
        }
        $jurusan = Jurusan::get();
        $tingkat = Tingkat::get();
        $angkatan= Angkatan::with('tingkat')->get();
        $mapel   = Mapel::get();
        $guru    = Guru::get();
        return view('be_page.kelas',['jurusan' => $jurusan, 'tingkat' => $tingkat, 'angkatan'=> $angkatan, 'mapel' => $mapel,'guru'=> $guru]);
    }

    public function hapus_mapel_master(Request $request)
    {
        $mapelmaster = Mapelmaster::where('id', $request->id)
        ->withCount(['tugas','jawabtugas','ujian','materi','komenvideo','jawabanmulti','docstugas','docs'])->first();
        if ($mapelmaster) {
            # code...
            if ($mapelmaster->tugas_count > 0) {
                # code...
                Tugas::where('mapelmaster_id', $request->id)->delete();
            }
            if ($mapelmaster->jawabtugas_count > 0) {
                # code...
                Jawabtugas::where('mapelmaster_id',$request->id)->delete();
            }
            if ($mapelmaster->ujian_count > 0) {
                # code...
                Ujian::where('mapelmaster_id',$request->id)->delete();
            }
            if ($mapelmaster->materi_count > 0) {
                # code...
                Materi::where('mapelmaster_id', $request->id)->delete();
            }
            if ($mapelmaster->komenvideo_count > 0) {
                # code...
                Komenvideo::where('mapelmaster_id',$request->id)->delete();
            }
            if ($mapelmaster->jawabanmulti_cunt > 0) {
                # code...
                Jawabanmulti::where('mapelmaster_id',$request->id)->delete();
            }
            if ($mapelmaster->docstugas_count > 0) {
                # code...
                Docstugas::where('mapelmaster_id',$request->id)->delete();
            }

            if ($mapelmaster->docs_count) {
                # code...
                Docs::where('mapelmaster_id',$request->id)->delete();
            }

            $mapelmaster->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Guru Kelas Berhasil Dihapus'
            ]);
        }else {
            # code...
            return response()->json([
                'status'=>400,
                'message'=>'Data Tidak Ditemukan'
            ]);
        }
    }

    public function daftar_guru_kelas(Request $request, $kelas_id)
    {
        if ($request->ajax()) {
            # code...
            $data = Mapelmaster::where('kelas_id',$kelas_id)->with(['guru','mapel','kelas'])->get();
            return DataTables::of($data)
            ->addColumn('guru', function($data) {
                return $data->guru->guru_name;
            })
            ->addColumn('mapel', function($data) {
                return $data->mapel->mapel_name;
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldelguru"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#addguru2"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            })
            ->rawColumns(['guru','mapel','opsi'])
            ->make(true);
        }   
    }

    public function daftar_mapel_kelas(Request $request, $id)
    {
        $datax = Kelas::where('id',$id)->first();
        $data  = $datax->mapel;
        return DataTables::of($data)
        ->addColumn('check', function ($data) {
            return '<input type="checkbox" class="sub_chk3" data-id="'.$data->id.'">';
        })
        // ->addColumn('jurusan', function ($data){
        //     return $data->angkatan->angkatan_name.' '.$data->jurusan->jurusan_name.' '.$data->angkatan->tingkat->tingkatan_name.' '.$data->kelas_name;
        // })
        ->rawColumns(['check'])
        ->make(true);
    }

    public function siswa_belum_masuk_kelas()
    {
        $data = Siswa::where('kelas_id',null)->get();
        return DataTables::of($data)
        ->addColumn('check', function ($data) {
            return '<input type="checkbox" class="sub_chk" data-id="'.$data->id.'">';
        })         
        ->rawColumns(['check'])
        ->make(true);
    }

    public function tambah_siswa_baru(Request $request)
    {
        $siswa_id = explode(',',$request->siswa_id);
        $siswa = Siswa::whereIn('id',$siswa_id)->update(['kelas_id'=>$request->kelas_id]);
        return response()->json([
            'status'=>200,
            'message'=> 'Siswa baru telah ditambahkan ke kelas terkait'
        ]);
    }

    public function total_jurusan_kelas(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $jurusan = Jurusan::count();
            $kelas   = Kelas::count();

            return response()->json([
                'status' => 200,
                'data' => [
                    'kelas' => $kelas,
                    'jurusan' => $jurusan,
                ]
            ]);
        }
    }

    public function post_jurusan_kelas(Request $request) {
        if ($request->ajax()) {
            # code...
            if ($request->keterangan == 'new') {
                # code...
                $validator = Validator::make($request->all(),[
                    'jurusan_name' => 'required',
                    'total_kelas' => 'required'
                ]);

                if ($validator->fails()) {
                    # code...
                    return response()->json([
                        'status' => 400,
                        'message'=> $validator->messages()
                    ]);
                }else {
                    # code...
                    $exist = Jurusan::where('jurusan_name', $request->jurusan_name)->first();
                    if (!$exist) {
                        # code...
                        DB::beginTransaction();
                        try {
                            //code...
                            $jurusan = Jurusan::create([
                                'jurusan_name' => $request->jurusan_name,
                                'jurusan_slug' => Str::slug($request->jurusan_name),
                            ]);
    
                            $kelas = Kelas::where('jurusan_id', $jurusan->id)->where('angkatan_id',$request->angkatan_id)->count();
                            $total = $kelas + $request->total_kelas;
                            for ($i=$kelas; $i < $total ; $i++) { 
                                # code...
                                $kelas_baru =  [
                                    'kelas_name' => $i+1,
                                    'jurusan_id' => $jurusan->id,
                                    'angkatan_id' => $request->angkatan_id,
                                ];
                                Kelas::insert($kelas_baru);
                            }  
                            DB::commit();

                        } catch (Exception $e) {
                            //throw $th;
                            DB::rollback();
                        }
                        
                        return response()->json([
                            'status' => 200,
                            'message' => 'new data has been updated',
                        ]);
                        
                    }else {
                        # code...
                        return response()->json([
                            'status' => 400,
                            'message' => ['jurusan tersebut sudah terdaftar'],
                        ]);
                    }
                }
            }else {
                # code...
                $validator = Validator::make($request->all(),[
                    'jurusan_id' => 'required',
                    'total_kelas' => 'required',
                    'angkatan_id' => 'required',
                ]);

                if ($validator->fails()) {
                    # code...
                    return response()->json([
                        'status' => 400,
                        'message'=> $validator->messages()
                    ]);
                }else {

                    $jurusan = Jurusan::where('id', $request->jurusan_id)->first();
                    $kelas   = Kelas::where('jurusan_id', $jurusan->id)->where('angkatan_id',$request->angkatan_id)->count();
                    $total = $kelas + $request->total_kelas;
                    for ($i=$kelas; $i < $total ; $i++) { 
                        # code...
                        $kelas_baru =  [
                            'kelas_name' => $i+1,
                            'jurusan_id' => $jurusan->id,
                            'angkatan_id' => $request->angkatan_id,
                        ];
                        Kelas::insert($kelas_baru);
                    }
                    
                    return response()->json([
                        'status' => 200,
                        'message' => 'new data has been updated',
                    ]);
                }
            }
        }
    }

    public function jurusan_dropdown(Request $request)
    {
        $jurusan = Jurusan::get();
        return response()->json([
            'status' => 200,
            'message' => 'menampilkan data jurusan',
            'data' => $jurusan,
        ]);
    }

    public function mapelkelas_dropdown(Request $request, $id)
    {
        $kelas = Kelas::where('id', $id)->first();
        $mapel = $kelas->mapel;
        if ($mapel->count() > 0) {
            # code...
            return response()->json([
                'status'=> 200,
                'message'=> 'menampilkan daftar mapel pada kelas',
                'data' => $mapel,
            ]);
        }else {
            # code...
            return response()->json([
                'status'=> 400,
                'message'=> 'tidak ada mapel dalam kelas tersebut',
                'data' => null,
            ]);
        }
    }

    public function angkatan_dropdown(Request $request)
    {
        $tingkat = Angkatan::with('tingkat')->get();
        return response()->json([
            'status' => 200,
            'message' => 'menampilkan data angkatan',
            'data' => $tingkat,
        ]);
    }

    public function tingkat_dropdown(){
        $tingkat = Tingkat::get();
        return response()->json([
            'status' => 200,
            'message' => 'menampilkan data tingkatan',
            'data' => $tingkat,
        ]);
    }

    public function remove_kelas(Request $request)
    {   
        $kelas = Kelas::where('id',$request->id)->withCount('siswa','mapel')->first();
        // $siswa = Siswa::where('kelas_id', $request->id)->count();
        
        if ($kelas->siswa_count > 0 && $kelas->mapel_count > 0) {
            # code...
            Siswa::where('kelas_id', $request->id)->delete();
            $kelas->mapel->detach();
            $kelas->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Siswa & Mapel yang ada pada kelas telah dihapus',
            ]);

        }elseif ($kelas->siswa_count > 0 && $kelas->mapel_count < 1) {
            # code...
            Siswa::where('kelas_id', $request->id)->delete();
            $kelas->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Siswa yang ada pada kelas telah dihapus',
            ]);
            
        }elseif ($kelas->siswa_count < 1 && $kelas->mapel_count > 0) {
            # code...
            $kelas->mapel->detach();
            $kelas->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Mapel yang ada pada kelas telah dihapus',
            ]);

        }elseif ($kelas->guru->count() > 0) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => 'Tidak dapat menghapus kelas yang terdapat guru didalamnya',
            ]);

        }else {
            # code...
            $kelas->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data has been deleted',
            ]);
        }
        
    }

    public function remove_jurusan(Request $request)
    {   
        $jurusan = Jurusan::where('id',$request->id)->withCount('kelas')->first();
        if ($jurusan->kelas_count > 0) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => 'tidak dapat menghapus jurusan yang memiliki kelas',
            ]);
           
        }else {
            # code...
            $jurusan->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data has been deleted',
            ]);
        }
        
    }

    public function change_dropdown_jurusan(Request $request, $jurusan_id)
    {
        if ($request->ajax()) {
            # code...
            $data = Kelas::where('jurusan_id', $jurusan_id)->withCount('siswa','mapel','guru')->with(['jurusan','angkatan','mapel'])->get();
            return DataTables::of($data)
            ->addColumn('angkatan_kelas', function($data) {
                return $data->angkatan->angkatan_name. ' - '.$data->angkatan->tingkat->tingkat_name;
            })
            ->addColumn('kelas_jurusan', function($data) {
                return $data->jurusan->jurusan_name.' '.$data->kelas_name;
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-jurusan_name="'.$data->jurusan->jurusan_name.'"
                data-kelas_name="'.$data->kelas_name.'" data-jurusan_id="'.$data->jurusan_id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            }) 
            ->addColumn('mapel', function($data){
                if ($data->mapel_count > 0) {
                    # code...
                    return '<a href="#">'.$data->mapel_count.' - mapel</a>';
                }else {
                    # code...
                    return '<a href="#" data-toggle="modal" data-target="#addmapel"
                    data-id="'.$data->id.'">'.$data->mapel_count.' - mapel</a>';
                }
            })
            ->addColumn('guru_kelas', function($data){
                return '<a href="#" data-toggle="modal" data-target="#addguru" data-id="'.$data->id.'">'.$data->guru_count.' - guru</a>';
            })
            ->addColumn('siswa', function($data){
                return number_format($data->siswa_count).' - siswa';
            }) 
            ->rawColumns(['kelas_jurusan','opsi','siswa','angkatan_kelas','mapel','guru_kelas'])
            ->make(true);
        }
    }

    public function change_dropdown_angkatan(Request $request, $angkatan_id)
    {
        if ($request->ajax()) {
            # code...
            $data = Kelas::where('angkatan_id', $angkatan_id)->withCount('siswa','mapel')->with(['jurusan','angkatan','mapel'])->get();
            return DataTables::of($data)
            ->addColumn('angkatan_kelas', function($data) {
                return $data->angkatan->angkatan_name. ' - '.$data->angkatan->tingkat->tingkat_name;
            })
            ->addColumn('kelas_jurusan', function($data) {
                return $data->jurusan->jurusan_name.' '.$data->kelas_name;
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-jurusan_name="'.$data->jurusan->jurusan_name.'"
                data-kelas_name="'.$data->kelas_name.'" data-jurusan_id="'.$data->jurusan_id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            }) 
            ->addColumn('mapel', function($data){
                if ($data->mapel_count > 0) {
                    # code...
                    return '<a href="#" data-toggle="modal" data-target="#manmapel">'.$data->mapel_count.' - mapel</a>';
                }else {
                    # code...
                    return '<a href="#" data-toggle="modal" data-target="#manmapel"
                    data-id="'.$data->id.'">'.$data->mapel_count.' - mapel</a>';
                }
            })
            ->addColumn('siswa', function($data){
                return number_format($data->siswa_count).' - siswa';
            })
            ->addColumn('guru_kelas', function($data){
                return '<a href="#" data-toggle="modal" data-target="#addguru" data-id="'.$data->id.'">'.$data->guru_count.' - guru</a>';
            }) 
            ->rawColumns(['kelas_jurusan','opsi','siswa','angkatan_kelas','mapel','guru'])
            ->make(true);
        }
    }

    public function daftar_jurusan(Request $request)
    {
        if ($request->ajax())
        {
            # code...
            $data = Jurusan::with('kelas')->withCount('kelas')->get();
            return DataTables::of($data)
            ->addColumn('total_kelas',function($data){
                return number_format($data->kelas_count).' - kelas';
            })
            ->addColumn('opsi', function($data){
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel2"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-jurusan_name="'.$data->jurusan_name.'"
                data-toggle="modal" data-target="#modaledit2"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            })
            ->rawColumns(['total_kelas','opsi'])
            ->make(true);
        }
    }   

    public function update_kelas(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->first();
        $exist = Kelas::where('kelas_name', $request->kelas_name)->where('jurusan_id', $request->jurusan_id)->first();
        // if ($exist) {
        //     # code...
        //     if ($exist->id == $request->id) {
        //         # jika sama maka update code...
        //         $kelas->update([
        //             'kelas_name' => $request->kelas_name
        //         ]);
        //         return response()->json([
        //             'status' => 200,
        //             'message' => 'nama kelas berhasil dirubah'
        //         ]);
        //     }else {
        //         # tidak dapat diupdate karena bertabrakan dengan kelas lain code...
        //         return response()->json([
        //             'status' => 400,
        //             'message' => 'terdapat nama kelas yang sama pada jurusan yang sama'
        //         ]);
        //     }
        // }else {
        //     # kelas baru code...
        //     $kelas->update([
        //         'kelas_name' => $request->kelas_name
        //     ]);
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'nama kelas berhasil dirubah'
        //     ]);
        // }
        $kelas->update([
            'kelas_name' => $request->kelas_name
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'nama kelas berhasil dirubah'
        ]);
    }

    public function update_jurusan(Request $request) 
    {
        $data = Jurusan::where('id', $request->id)->first();
        $exist = Jurusan::where('jurusan_name', $request->jurusan_name)->first();
        if ($exist) {
            # code...
            if ($exist->id == $request->id) {
                # code...
                $data->update([
                    'jurusan_name'=> $request->jurusan_name
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'jurusan berhasil diperbarui'
                ]);
            }else {
                # code...
                return response()->json([
                    'status'=> 400,
                    'message' => 'terdapat jurusan dengan nama yang sama'
                ]);
            }
        }else {
            # code...
            $data->update([
                'jurusan_name'=> $request->jurusan_name
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'jurusan berhasil diperbarui'
            ]);
        }
    }

    

    public function remove_mapel_kelas(Request $request)
    {
        $kelas = Kelas::findOrFail($request->kelas_id);
        $mapel_id = explode(',',$request->mapel_id);
        $kelas->mapel()->detach($mapel_id);

        return response()->json([
            'status'=> 200,
            'message' => 'mapel tersebut telah dihapus dari kelas'
        ]);
    }

    public function copas_mapel_kelas(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->first();
        $kelas_id = explode(',',$request->kelas_id);
        
        foreach ($kelas->mapel as $key => $value) {
            # code...
            $value->kelas()->syncWithoutDetaching($kelas_id);
        }

        return response()->json([
            'status'=> 200,
            'message' => 'Mapel pada kelas berasil disalin ke kelas yang dipilih'
        ]);        
    }

    

}
