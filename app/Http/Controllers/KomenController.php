<?php

namespace App\Http\Controllers;
use App\Models\Vids;
use App\Models\Komenvideo;
use Crypt;
use Validator;
use Illuminate\Http\Request;

class KomenController extends Controller
{
    public function display_komen_video(Request $request, $vids_id)
    {
        $vids_id = Crypt::decrypt($vids_id);
        $video = Vids::findOrFail($vids_id);
        return view('fe_page.komen_materi_video',compact('video'));
    }

    public function post_komen_video(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'mapelmaster_id' => 'required',
            'vids_id'=> 'required',
            'materi_id' => 'required',
            'siswa_id'=> 'required',
            'komen'=> 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message'=> $validator->messages()
            ]);
        }else {
            $data = Komenvideo::updateOrCreate(
                [
                    'id'=> $request->id,
                ],
                [
                    'mapelmaster_id' => $request->mapelmaster_id,
                    'vids_id'=> $request->vids_id,
                    'siswa_id'=> $request->siswa_id,
                    'materi_id' => $request->materi_id,
                    'komen'=> $request->komen
                ]
            );

            $komen = Komenvideo::where('id', $data->id)->with('siswa')->first();

            return response()->json(
                [
                    'status'=> 200,
                    'message'=> 'Komentar dipublikasikan',
                    'data'=> $komen,
                ]
            );
        }
    }

    public function display_komen($vids_id)
    {
        $data = Komenvideo::where('vids_id', $vids_id)->with('siswa')->orderBy('id','desc')->paginate(5);
        return response()->json([
            'status'=>200,
            'message'=>'menampilkan komentar materi video',
            'data' => $data
        ]);
    }
}
