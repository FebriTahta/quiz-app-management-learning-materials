<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Detailsiswa;
use DataTables;
use DB;
use File;
use Image;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function admin_siswa(Request $request)
    {
        if ($request->ajax()) {
            # code...

        }

        return view('be_page.siswa');
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public function update_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id'       => 'required',
            'img_siswa'      => 'required|max:2048',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            $exist = Detailsiswa::where('siswa_id', $request->siswa_id)->first();
            if ($exist) {
                # code...
                if($request->hasFile('img_siswa')) {
                    # code...
                    if( File::exists(public_path('image_siswa/'.$exist->img_siswa))){
                        File::delete(public_path('image_siswa/'.$exist->img_siswa));
                        File::delete(public_path('siswa_image/'.$exist->img_siswa));
                    }
                    $filename    = time().'.'.$request->img_siswa->getClientOriginalExtension();
                    $request->file('img_siswa')->move('siswa_image/',$filename);
                    $thumbnail   = $filename;
                    File::copy(public_path('siswa_image/'.$filename), public_path('image_siswa/'.$thumbnail));
                        
                    $largethumbnailpath = public_path('siswa_image/'.$thumbnail);
                    $this->createThumbnail($largethumbnailpath, 366, 431);

                    $data = DetailSiswa::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'siswa_id' => $request->siswa_id,
                            'img_siswa' => $filename,
                        ]
                    );

                    return response()->json(
                        [
                            'status' => 200,
                            'message' => 'data berhasil di update',
                        ]
                    );

                }else {
                    # code...
                    return response()->json([
                        'status' => 400,
                        'message' => ['Tidak ada image'],
                    ]);
                }

            }else {
                # code...
                $filename    = time().'.'.$request->img_siswa->getClientOriginalExtension();
                $request->file('img_siswa')->move('siswa_image/',$filename);
                $thumbnail   = $filename;
                File::copy(public_path('siswa_image/'.$filename), public_path('image_siswa/'.$thumbnail));
                    
                $largethumbnailpath = public_path('siswa_image/'.$thumbnail);
                $this->createThumbnail($largethumbnailpath, 366, 431);

                $data = DetailSiswa::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'siswa_id' => $request->siswa_id,
                        'img_siswa' => $filename,
                    ]
                );

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'data berhasil di update',
                    ]
                );
            }
        }
    }

    

    public function siswa_kelas($kelas_id,Request $request)
    {
        $data = Siswa::where('kelas_id', $kelas_id)->with(['kelas'])->get();
        return DataTables::of($data)
        ->addColumn('opsi', function($data){
            $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
            data-toggle="modal" data-target="#modaldel2"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
            $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-jurusan_name="'.$data->jurusan_name.'"
            data-toggle="modal" data-target="#modaledit2"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
            return $btn;
        })
        ->addColumn('status', function($data){
            $status;
            if ($data->siswa_status == 'aktif') {
                # code...
                $status = '<button class="btn btn-sm btn-info" data-id="'.$data->id.'" data-toggle="modal" data-target="#modalstatus"
                 data-status="'.$data->siswa_status.'" data-kata="Apa anda yakin akan menonaktifkan status siswa ini ?">'.$data->siswa_status.'</button>';
            }else {
                # code...
                $status = '<button class="btn btn-sm btn-warning" data-id="'.$data->id.'" data-toggle="modal" data-target="#modalstatus"
                 data-status="'.$data->siswa_status.'" data-kata="Apa anda yakin akan mengaktifkan status siswa ini ?">non aktif</button>';
            }
            return $status;
        })
        ->rawColumns(['opsi','status'])
        ->make(true);
    }

    public function status_siswa(Request $request)
    {
        $siswa = Siswa::where('id', $request->id)->first();
        if ($request->status == 'aktif') {
            # code...
            $siswa->update([
                'siswa_status' => 'off'
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'status siswa ('.$siswa->siswa_name.') telah di nonaktifkan',
                'data' => $siswa->siswa_status,
            ]);
        }else {
            # code...
            $siswa->update([
                'siswa_status' => 'aktif'
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'status siswa ('.$siswa->siswa_name.') telah di diaktifkan',
                'data' => $siswa->siswa_status,
            ]);
        }
    }
}
