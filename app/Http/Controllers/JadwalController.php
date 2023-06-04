<?php

namespace App\Http\Controllers;
use App\Models\Hari;
use App\Models\User;
use App\Models\Notif;
use App\Models\Mapelmaster;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function dropdown_hari(Request $request)
    {
        $hari = Hari::get();
        return response()->json([
            'status'=>200,
            'message'=>'display data hari dalam satu minggu',
            'data'=> $hari,
        ]);
    }

    public function admin_jadwal(Request $request)
    {
        $hari = Hari::with('mapelmaster')->withCount('mapelmaster')->get();
        $mapelmaster = Mapelmaster::count();
        $today = Carbon::parse(now())->format('l');
        $jadwal_hari_ini = Mapelmaster::whereHas('hari', function($query) use ($today){
            $query->where('hari_eng', $today);
        })->with(['materi','tugas','ujian'])->withCount(['materi','tugas','ujian'])->get();

        $no_materi = [];
        foreach ($jadwal_hari_ini as $key => $value) {
            # code...
            if ($value->materi_count < 1 && $value->tugas_count < 1 && $value->ujian_count < 1) {
                # code...
                $no_materi[] = 
                $value->mapel->mapel_name.' - '.
                $value->kelas->angkatan->tingkat->tingkat_name.' '.
                $value->kelas->kelas_name.' |'.
                $value->guru->guru_name.' : No Action / No Materi';
            }
        }

        return view('be_page.jadwal',compact('hari','mapelmaster','jadwal_hari_ini','today','no_materi'));
    }

    protected function notif($pesan,$judul)
    {
        $admin = User::where('role','admin')->get();
        
        $data_notif = [];
        $user_id = [];
        foreach ($admin as $key => $s) {
            # code...
            foreach ($pesan as $k => $v) {
                # code...
                $user_id[] = $s->id;
                $data_notif [] = [
                    'user_id' => $s->id,
                    'pesan' => $pesan[$k],
                    'link'    => '/admin-jadwal/',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'status' => 'unread',
                ];
            }
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
                    "body" => 'Ada guru yang tidak melakukan action',
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

    public function update_notif_jadwal_admin(Request $request)
    {
        $notif = Notif::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->get();
        $total = Notif::where('user_id', Auth::user()->id)->where('status','unread')->count();
        $notif_all = Notif::where('user_id', Auth::user()->id)->limit(10)->get();
        if ($notif->count() > 0) {
            # code...
            $notif = Notif::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->get();
            $total = Notif::where('user_id', Auth::user()->id)->where('status','unread')->count();
            $notif_all = Notif::where('user_id', Auth::user()->id)->limit(10)->get();
            return response()->json([
                'status'=>400,
                'message'=>'Notif sudah ditampilkan',
                'total' => $total,
                'data'=> $notif_all,
            ]);
        }else {
            # code...
            $today = Carbon::parse(now())->format('l');
            $jadwal_hari_ini = Mapelmaster::whereHas('hari', function($query) use ($today){
                $query->where('hari_eng', $today);
            })->with(['materi','tugas','ujian'])->withCount(['materi','tugas','ujian'])->get();

            $no_materi = [];
            foreach ($jadwal_hari_ini as $key => $value) {
                # code...
                if ($value->materi_count < 1 && $value->tugas_count < 1 && $value->ujian_count < 1) {
                    # code...
                    $no_materi[] = 
                    $value->mapel->mapel_name.' - '.
                    $value->kelas->angkatan->tingkat->tingkat_name.' '.
                    $value->kelas->kelas_name.' |'.
                    $value->guru->guru_name.' : No Action / No Materi';
                }
            }
            $judul;
            if (count($no_materi) > 0) {
                # code...
                $judul = 'Ada Guru yang tidak melakukan action';
            }else {
                # code...
                $judul = 'Semua guru sudah melakukan action dengan baik';
            }

            $total = Notif::where('user_id', Auth::user()->id)->where('status','unread')->count();
            $notif_all = Notif::where('user_id', Auth::user()->id)->limit(10)->get();
            $this->notif($no_materi,$judul);
            
            return response()->json([
                'status'=>200,
                'message'=>'menampilkan notifikasi guru yang tidak melakukan action pada jadwal hari ini',
                'total' => $total,
                'data'=> $notif_all,
            ]);
        }
    }
}
