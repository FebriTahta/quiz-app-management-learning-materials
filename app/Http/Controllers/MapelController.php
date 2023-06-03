<?php

namespace App\Http\Controllers;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Support\Str;
use Image;
use File;
use Validator;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function admin_mapel()
    {
        return view('be_page.mapel');
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public function get_mapel(Request $request)
    {
        $data = Mapel::orderBy('id','desc')->get();
        return response()->json([
            'status' => 200,
            'message' => 'menampilkan data mapel',
            'data' => $data,
        ]);
    }

    public function remove_mapel(Request $request)
    {
        $id   = $request->id; 
        $data = Mapel::where('id', $id)->first();
        
        if(File::exists(public_path('image_mapl/'.$data->image))){
            File::delete(public_path('image_mapl/'.$data->image));
            File::delete(public_path('mapl_image/'.$data->image));
            $data->delete();
            $jumlah = Mapel::count();
            return response()->json([
                'status' => 200,
                'message' => 'data mapel berhasil dihapus',
                'id' => $id,
                'jumlah' => $jumlah
            ]);
        }else{
            $data->delete();
            $jumlah = Mapel::count();
            return response()->json([
                'status' => 200,
                'message' => 'data mapel berhasil dihapus',
                'id' => $id,
                'jumlah' => $jumlah
            ]);
        }
    }

    public function total_mapel()
    {
        $mapel = Mapel::count();
        return response()->json([
            'status' => 200,
            'message' => 'show data mapel',
            'total' => $mapel,
        ]);
    }

    public function post_mapel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapel_name'       => 'required',
            'image'            => 'max:2048',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            if($request->hasFile('img')) {
                $filename    = time().'.'.$request->img->getClientOriginalExtension();
                $request->file('img')->move('mapl_image/',$filename);
                $thumbnail   = $filename;
                File::copy(public_path('mapl_image/'.$filename), public_path('image_mapl/'.$thumbnail));
                    
                $largethumbnailpath = public_path('mapl_image/'.$thumbnail);
                $this->createThumbnail($largethumbnailpath, 318, 159);

                $data = Mapel::create(
                    [
                        
                        'mapel_name'    =>$request->mapel_name,
                        'mapel_slug'    =>Str::slug($request->mapel_name),
                        'image'         =>$filename,
                        'thumbnail'     =>$thumbnail,
                    ]
                );
                return response()->json([
                    'status' => 200,
                    'message' => 'mapel berhasil ditambahkan',
                    'data' => $data,
                    'image' => $data->image,
                ]);
            }else {
                # code...
                $data = Mapel::create(
                    [
                        
                        'mapel_name'    =>$request->mapel_name,
                        'mapel_slug'    =>Str::slug($request->mapel_name),
                    ]
                );
                return response()->json([
                    'status' => 200,
                    'message' => 'mapel berhasil ditambahkan',
                    'data' => $data,
                    'image' => $data->image,
                ]);
            }
        }
    }

    public function update_mapel(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'mapel_name'       => 'required|',
            'image'            => 'max:2048',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            $data = Mapel::where('id', $request->id)->first();
            $exist = Mapel::where('mapel_name', $request->mapel_name)->first();
            $semua = Mapel::get();
            if($request->hasFile('img')) {
                if ($exist) {
                    # code...
                    if ($exist->id == $data->id) {
                        # code...
                        if(File::exists(public_path('image_mapl/'.$data->image))){
                            File::delete(public_path('image_mapl/'.$data->image));
                            File::delete(public_path('mapl_image/'.$data->image));
                        }
                        $filename    = time().'.'.$request->img->getClientOriginalExtension();
                        $request->file('img')->move('mapl_image/',$filename);
                        $thumbnail   = $filename;
                        File::copy(public_path('mapl_image/'.$filename), public_path('image_mapl/'.$thumbnail));
                            
                        $largethumbnailpath = public_path('mapl_image/'.$thumbnail);
                        $this->createThumbnail($largethumbnailpath, 318, 159);
        
                        $data->update([
                            'mapel_name'    =>$request->mapel_name,
                            'mapel_slug'    =>Str::slug($request->mapel_name),
                            'image'         =>$filename,
                            'thumbnail'     =>$thumbnail,
                        ]);
                        
                        return response()->json([
                            'status' => 200,
                            'message' => 'mapel berhasil ditambahkan',
                            'data' => $data,
                            'image' => $data->image,
                            'id' => $data->id,
                            'semua' => $semua
                        ]);
                    }else {
                        # code...
                        return response()->json([
                            'status' => 400,
                            'message' => ['nama mapel tersebut sudah terdaftar dalam sistem'],
                        ]);
                    }
                }else {
                    # code...
                    $data->update([
                        'mapel_name'    =>$request->mapel_name,
                        'mapel_slug'    =>Str::slug($request->mapel_name),
                        'image'         =>$filename,
                        'thumbnail'     =>$thumbnail,
                    ]);
                    
                    return response()->json([
                        'status' => 200,
                        'message' => 'mapel berhasil ditambahkan',
                        'data' => $data,
                        'image' => $data->image,
                        'id' => $data->id,
                        'semua' => $semua
                    ]);
                }
                

                
            }else {
                # code...
                if ($exist) {
                    # code...
                    if ($exist->id == $data->id) {
                        # code...
                        $data->update([
                            'mapel_name'    =>$request->mapel_name,
                            'mapel_slug'    =>Str::slug($request->mapel_name),
                        ]);
                        return response()->json([
                            'status' => 200,
                            'message' => 'mapel berhasil ditambahkan',
                            'data' => $data,
                            'image' => $data->image,
                            'id' => $data->id,
                            'semua' => $semua
                        ]);
                    }else {
                        # code...
                        return response()->json([
                            'status' => 400,
                            'message' => ['nama mapel tersebut sudah terdaftar dalam sistem'],
                        ]);
                    }
                }else {
                    # code...
                    $data->update([
                        'mapel_name'    =>$request->mapel_name,
                        'mapel_slug'    =>Str::slug($request->mapel_name),
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'mapel berhasil ditambahkan',
                        'data' => $data,
                        'image' => $data->image,
                        'id' => $data->id,
                        'semua' => $semua
                    ]);
                }
                
            }
        }
    }

    public function post_kelas_mapel(Request $request)
    {
        $kelas = Kelas::find($request->id);
        $kelas->mapel()->attach($request->mapel_id);

        return response()->json([
            'status' => 200,
            'message' => 'mapel berhasil ditambahkan dalam kelas'
        ]);
    }
}
