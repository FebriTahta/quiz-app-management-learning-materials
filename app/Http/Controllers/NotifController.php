<?php

namespace App\Http\Controllers;
use App\Models\Notif;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Hari;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function get_my_notif(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $session = Auth::user()->id;
            $notif   = Notif::where('user_id', $session)->orderBy('created_at','desc')->limit(20)->get(); 
            $last    = Notif::where('user_id', $session)->latest()->first();
            $total   = Notif::where('user_id', $session)->where('status','unread')->count(); 
            $tanggal = [];
            foreach ($notif as $key => $value) {
                # code...
                $tanggal[] = Carbon::parse($value->created_at)->format('d-m-Y / H:i');
            }
            $pesan;
            if ($last == null) {
                # code...
                $pesan = 'belum ada notifikasi';
            }else {
                # code...
                $pesan = $last->pesan;
            }
            
            return response()->json([
                'status'=>200,
                'message'=>'Display Notif Each Session',
                'data'=> $notif,
                'total'=> $total,
                'last'=> $pesan,
                'tanggal'=> $tanggal,
            ]);
        }
    }

    


    public function test()
    {
        $hari = [
            [
                'hari_ind'=>'senin',
            ],
            [
                'hari_ind'=>'selasa',
            ]
        ];
        return $hari;
        return 'use this method for testing anything';
    }

    public function read_all_notif(Request $request)
    {
        $session = Auth::user()->id;
        $notif   = Notif::where('user_id', $session)->where('status', 'unread')->update([
            'status'=>'read'
        ]);
        $get_notif   = Notif::where('user_id', $session)->orderBy('created_at','desc')->limit(20)->get(); 

        return response()->json([
            'status'=>200,
            'message'=> 'all notification turning to read status',
            'data'=> $get_notif,
        ]);
        
    }
}
