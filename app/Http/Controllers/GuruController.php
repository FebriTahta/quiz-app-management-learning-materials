<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Detailguru;
use App\Models\Mapelmaster;
use Image;
use File;
use DataTables;
use Validator;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function admin_guru(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Guru::with(['kelas'])->get();
            return DataTables::of($data)
            ->addColumn('photos', function($data){
                $pho;
                if ($data->photo == null || $data->photo == "") {
                    # code...
                    $pho = '<span style="color:red">kosong</span>';
                }else {
                    # code...
                    $pho = '<img style="max-width:300px" src="'.$data->image.'" alt="">';
                }
                return $pho;
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-xs btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
                $btn .= ' <button class="btn btn-xs btn-info" data-id="'.$data->id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="icon icon-pencil"></i></button>';
                return $btn;
            })
            ->addColumn('stats',function($data){
                $sts;
                if ($data->guru_status == "aktif") {
                    # code...
                    $sts = '<button class="btn btn-sm btn-primary">aktif</button>';
                }else{
                    $sts = '<button class="btn btn-sm btn-warning">tidak aktif</button>';
                }
                return $sts;
                
            })
            ->rawColumns(['photos','opsi','stats'])
            ->make(true);
        }
        return view('be_page.guru');
    }

    public function total_guru(Request $request)
    {
        $data = Guru::count();
        if ($data > 0) {
            # code...
            return response()->json([
                'status' => 200,
                'message' => 'menampilkan '.$data.' data guru',
                'data' => $data,
            ]);
        }else {
            # code...
            return response()->json([
                'status' => 400,
                'message' => 'tidak ditemukan data guru',
                'data' => $data,
            ]);
        }
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public function post_mapel_master(Request $request)
    {
        foreach ($request->mapel_id as $key => $value) {
            # code...
            $exist = Mapelmaster::where('guru_id', $request->guru_id)
            ->where('mapel_id',$request->mapel_id[$key])
            ->where('kelas_id', $request->id)
            ->first();
            if (!$exist) {
                # code...
                Mapelmaster::create([
                    'guru_id'=> $request->guru_id,
                    'mapel_id'=> $request->mapel_id[$key],
                    'kelas_id'=> $request->id,
                ]);
            }
            
        }

        return response()->json([
            'status'=> 200,
            'message'=> 'Guru pengampuh mapel telah ditambahkan'
        ]);
    }

    public function post_mapel_master2(Request $request)
    {
        // foreach ($request->mapel_id as $key => $value) {
        //     # code...
        //     $exist = Mapelmaster::where('guru_id', $request->guru_id)
        //     ->where('mapel_id',$request->mapel_id[$key])
        //     ->where('kelas_id', $request->id)
        //     ->first();
        //     if (!$exist) {
        //         # code...
        //         Mapelmaster::create([
        //             'guru_id'=> $request->guru_id,
        //             'mapel_id'=> $request->mapel_id[$key],
        //             'kelas_id'=> $request->id,
        //         ]);
        //     }
            
        // }

        foreach ($request->mapel_id as $key => $value) {
            $data = Mapelmaster::where('id',$request->id)
            ->update([
                    'guru_id'=> $request->guru_id,
                    'mapel_id'=> $request->mapel_id[$key],
            ]);
        }
        return response()->json([
            'status'=> 200,
            'message'=> 'Guru pengampuh mapel telah ditambahkan'
        ]);
    }

    public function update_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guru_id'       => 'required',
            'wa_guru'       => 'required',
            'img_guru'      => 'required|max:2048',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            $exist = Detailguru::where('guru_id', $request->guru_id)->first();
            if ($exist) {
                # code...
                if($request->hasFile('img_guru')) {
                    # code...
                    if( File::exists(public_path('image_guru/'.$exist->img_guru))){
                        File::delete(public_path('image_guru/'.$exist->img_guru));
                        File::delete(public_path('guru_image/'.$exist->img_guru));
                    }
                    $filename    = time().'.'.$request->img_guru->getClientOriginalExtension();
                    $request->file('img_guru')->move('guru_image/',$filename);
                    $thumbnail   = $filename;
                    File::copy(public_path('guru_image/'.$filename), public_path('image_guru/'.$thumbnail));
                        
                    $largethumbnailpath = public_path('guru_image/'.$thumbnail);
                    $this->createThumbnail($largethumbnailpath, 366, 431);

                    $data = Detailguru::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'guru_id' => $request->guru_id,
                            'img_guru' => $filename,
                            'wa_guru' => $request->wa_guru,
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
                    $data = Detailguru::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'guru_id' => $request->guru_id,
                            'wa_guru' => $request->wa_guru,
                        ]
                    );

                    return response()->json(
                        [
                            'status' => 200,
                            'message' => 'data berhasil di update',
                        ]
                    );
                }

            }else {
                # code...
                $filename    = time().'.'.$request->img_guru->getClientOriginalExtension();
                $request->file('img_guru')->move('guru_image/',$filename);
                $thumbnail   = $filename;
                File::copy(public_path('guru_image/'.$filename), public_path('image_guru/'.$thumbnail));
                    
                $largethumbnailpath = public_path('guru_image/'.$thumbnail);
                $this->createThumbnail($largethumbnailpath, 366, 431);

                $data = Detailguru::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'guru_id' => $request->guru_id,
                        'img_guru' => $filename,
                        'wa_guru' => $request->wa_guru,
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

    public function update_photo2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guru_id'       => 'required',
            'wa_guru'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            $exist = Detailguru::where('guru_id', $request->guru_id)->first();
            if ($exist) {
                # code...
                if($request->hasFile('img_guru')) {
                    # code...
                    if( File::exists(public_path('image_guru/'.$exist->img_guru))){
                        File::delete(public_path('image_guru/'.$exist->img_guru));
                        File::delete(public_path('guru_image/'.$exist->img_guru));
                    }
                    $filename    = time().'.'.$request->img_guru->getClientOriginalExtension();
                    $request->file('img_guru')->move('guru_image/',$filename);
                    $thumbnail   = $filename;
                    File::copy(public_path('guru_image/'.$filename), public_path('image_guru/'.$thumbnail));
                        
                    $largethumbnailpath = public_path('guru_image/'.$thumbnail);
                    $this->createThumbnail($largethumbnailpath, 366, 431);

                    $data = Detailguru::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'guru_id' => $request->guru_id,
                            'img_guru' => $filename,
                            'wa_guru' => $request->wa_guru,
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
                    $data = Detailguru::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'guru_id' => $request->guru_id,
                            'wa_guru' => $request->wa_guru,
                        ]
                    );

                    return response()->json(
                        [
                            'status' => 200,
                            'message' => 'data berhasil di update',
                        ]
                    );
                }

            }else {
                # code...
                $filename    = time().'.'.$request->img_guru->getClientOriginalExtension();
                $request->file('img_guru')->move('guru_image/',$filename);
                $thumbnail   = $filename;
                File::copy(public_path('guru_image/'.$filename), public_path('image_guru/'.$thumbnail));
                    
                $largethumbnailpath = public_path('guru_image/'.$thumbnail);
                $this->createThumbnail($largethumbnailpath, 366, 431);

                $data = Detailguru::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'guru_id' => $request->guru_id,
                        'img_guru' => $filename,
                        'wa_guru' => $request->wa_guru,
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

    public function update_bio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guru_id'       => 'required',
            'quote'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            $data = Guru::where('id', $request->guru_id)->update(
                [
                    'quote'=> $request->quote,
                ]
            );

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'bio berhasil di update',
                ]
            );
        }
    }
}
