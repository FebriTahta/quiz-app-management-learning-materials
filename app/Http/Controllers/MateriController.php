<?php

namespace App\Http\Controllers;
use App\Models\Mapelmateri;
use App\Models\Materi;
use App\Models\Vids;
use App\Models\Docs;
use App\Models\Ujian;
use App\Models\Soalmulti;
use App\Models\Optionmulti;
use App\Models\Mapelmaster;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Notif;
use App\Models\User;
use Crypt;
use Response;
use File;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    protected function notif($mapelmaster_id, $pesan,$judul)
    {
        $mapelmaster = Mapelmaster::where('id',$mapelmaster_id)->with('kelas')->first();
        $kelas = Kelas::where('id', $mapelmaster->kelas_id)->first();
        $siswa = Siswa::where('kelas_id',$kelas->id)->get();
        // $materi= Materi::where('id', $materi_id)->first();
        
        $data_notif = [];
        $user_id = [];
        foreach ($siswa as $key => $s) {
            # code...
            $user_id[] = $s->user_id;
            $data_notif [] = [
                'user_id' => $s->user_id,
                // 'pesan'   => 'video '.$request->vids_name. ' telah ditambahkan ke materi : '.$materi->materi_name,
                'pesan' => $pesan,
                'link'    => '/mapel-siswa/'.Crypt::encrypt($mapelmaster_id),
                'created_at' => now(),
                'updated_at' => now(),
                'status' => 'unread',
            ];
        }

        foreach (array_chunk($data_notif, 100) as $chunk) {
            # code...
            Notif::insert($chunk);
        }

        $web_token = User::whereIn('id',$user_id)->whereNotNull('web_token')->get();
        $SERVER_API_KEY = "AAAAf7-1TE0:APA91bFyNs20dN3U9q-qEXnykmUDBOaT8xnV9nmM93yUrG01Awq_CuPP979BNfGnM-63XnqmPhnci6rrilg5-IyigjpiNI_BLxsnjTZmKHc_XY69Fq4gbvdzw3-NJpvnnYjjLm9kV_Q3";

        foreach ($web_token as $key => $w_t) {
            # code...
            $pesan_notif = [
                "registration_ids" => array($w_t->web_token),
                "notification" => [
                    "title" => $judul,
                    "body" => $pesan,
                    // "body" => 'video '.$request->vids_name. ' telah ditambahkan ke materi : '.$materi->materi_name,
                    "content_available" => true,
                    "priority" => "high",
                ]
            ];
            $dataString = json_encode($pesan_notif);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        }
    }

    public function post_materi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'materi_name'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            $data = Materi::updateOrCreate(
                [
                    'id'=> $request->id,
                ],
                [
                    'mapelmaster_id'=> $request->mapelmaster_id,
                    'guru_id' => $request->guru_id,
                    'kelas_id' => $request->kelas_id,
                    'uploader_nip' => $request->uploader_nip,
                    'materi_name' => $request->materi_name,
                    'materi_slug' => Str::slug($request->materi_name)
                ]
            );

            return response()->json([
                'status'=> 200,
                'message' => 'Materi baru ditambahkan'
            ]);
        }
    }

    public function post_vids(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapelmaster_id'  => 'required',
            'materi_id'       => 'required',
            'vids_name'       => 'required',
            'vids_desc'       => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 200,
                'message' => $validator->messages(),
            ]);
        }else {
            # code...
            $source = $request->vids_link;
            $base = 'https://www.youtube.com/watch?v=';
            if (substr($source,0,32) !== $base) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message' => ['Sumber URL dari Link Youtube'],
                ]);
            }else {
                # code...
                $data = Vids::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'vids_name' => $request->vids_name,
                        'vids_link' => 'https://www.youtube.com/embed/'.substr($source,32),
                        'vids_desc' => $request->vids_desc,
                        'materi_id' => $request->materi_id,
                    ]
                );
    
                $materi= Materi::where('id', $request->materi_id)->first();
                $pesan = 'video '.$request->vids_name. ' telah ditambahkan ke materi : '.$materi->materi_name;
                $judul = 'Materi Video Baru';
                $this->notif($request->mapelmaster_id, $pesan, $judul);

                return response()->json([
                    'status' => 200,
                    'message' => 'video baru berhasil ditambahkan'
                ]);
            }
        }
    }

    public function post_docs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapelmaster_id'  => 'required',
            'materi_id'       => 'required',
            'docs_file'       => 'required|mimes:pdf,docx,csv,xlsx,ppt,pptx,rar',
            'docs_name'       => 'required',
            'docs_desc'       => 'required|'
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
                    $exist = Docs::findOrFail($request->id);
                    if ($exist) {
                        # code...
                        if(File::exists(public_path('docs_files/'.$exist->docs_files)))
                        {
                            File::delete(public_path('docs_files/'.$exist->docs_files));
                        }
                    }
                }

                $filename    = time().'_'.$request->docs_file->getClientOriginalName();
                $request->file('docs_file')->move('docs_files/',$filename);

                $data = Docs::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'mapelmaster_id' => $request->mapelmaster_id,
                        'materi_id' => $request->materi_id,
                        'docs_file' => $filename,
                        'docs_name' => $request->docs_name,
                        'docs_desc' => $request->docs_desc,
                    ]
                );

                $materi= Materi::where('id', $request->materi_id)->first();
                $pesan = 'dokumen '.$request->docs_name. ' telah ditambahkan ke materi : '.$materi->materi_name;
                $judul = 'Dokumen Baru';
                $this->notif($request->mapelmaster_id, $pesan, $judul);
                
            }else {
                # code...
                $data = Docs::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'materi_id' => $request->materi_id,
                        'docs_name' => $request->docs_name,
                        'docs_desc' => $request->docs_desc,
                    ]
                );

                $materi= Materi::where('id', $request->materi_id)->first();
                $pesan = 'dokumen '.$request->docs_name. ' telah ditambahkan ke materi : '.$materi->materi_name;
                $judul = 'Dokumen Baru';
                $this->notif($request->mapelmaster_id, $pesan, $judul);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Dokumen barhasil ditambahkan ke materi terkait'
            ]);
        }
    }

    public function download_docs($docs_id)
    {
        $docs = Docs::findOrFail($docs_id);
        $filepath = public_path('docs_files/'.$docs->docs_file);
        return Response::download($filepath); 
    }

    public function remove_vids(Request $request)
    {
        $data = Vids::findOrFail($request->id);
        $data->delete();
        return response()->json([
            'status'=>200,
            'message'=> 'materi video telah dihapus'
        ]);
    }

    public function remove_docs(Request $request)
    {
        $data = Docs::findOrFail($request->id);
        if(File::exists(public_path('docs_files/'.$data->docs_files)))
        {
            File::delete(public_path('docs_files/'.$data->docs_files));
            $data->delete();
        }else {
            # code...
            $data->delete();
        }
        return response()->json([
            'status'=>200,
            'message'=> 'materi dokumen telah dihapus'
        ]);
    }

    public function hapus_materi(Request $request)
    {
        $materi = Materi::where('id', $request->id)->withCount(['docs','vids','ujian'])->first();
        if ($materi->docs_count > 0) {
            # code...
            Docs::where('materi_id',$materi->id)->delete();
        }
        if ($materi->vids_count > 0) {
            # code...
            Vids::where('materi_id',$materi->id)->delete();
        }
        if ($materi->ujian_count > 0) {
            # code...
            $ujian = Ujian::where('materi_id',$materi->id)->get();
            foreach ($ujian as $keyx => $value) {
                # code...
                $soal = Soalmulti::where('ujian_id',$value->id)->get();
                foreach ($soal as $keyz => $val) {
                    # code...
                    Optionmulti::where('soalmulti_id',$val->id)->delete();
                }
                Soalmulti::where('ujian_id',$value->id)->delete();
            }
            Ujian::where('materi_id',$materi->id)->delete();
        }
        
        $materi->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Materi berhasil dihapus'
        ]);
    }

    public function update_materi(Request $request)
    {
        $materi = Materi::where('id',$request->id)->update([
            'materi_name'=>$request->materi_name
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'Materi berhasil diperbarui'
        ]);
    }
}
