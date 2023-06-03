<?php

namespace App\Http\Controllers;
use Cache;
use Carbon;
use App\Models\User;
use DataTables;
use App\Models\Userakses;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin_dashboard_page(Request $request)
    {
        return view('be_page.dashboard');
    }

    public function total_user_online(Request $request)
    {
        if ($request->ajax()) {
            # code...
            
            $user = User::whereNotNull('last_seen')->orderBy('last_seen', 'DESC')->get();
            $online = [];
            foreach ($user as $key => $value) {
                # code...
                if(Cache::has('user-is-online-' . $value->id)){
                    $online[] = 1;
                }
            }
            $semua   = User::count();
            $offline = $semua - array_sum($online);
            return response()->json([
                'status'=>200,
                'message'=>'total user online',
                'data'=>array_sum($online),
                'offline'=>$offline,
            ]);
        }
    }

    public function last_four_online(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $users = User::select("*")
                    ->whereNotNull('last_seen')
                    ->orderBy('last_seen', 'DESC')
                    ->limit(4)->get();
            $last_seen = [];
            foreach ($users as $key => $value) {
                # code...
                $last_seen[] = Carbon\Carbon::parse($value->last_seen)->diffForHumans();
            }

            $online = [];
            foreach ($users as $key => $value) {
                # code...
                if(Cache::has('user-is-online-' . $value->id)){
                    $online[] = $value;
                }
            }

            return response()->json([
                'status'=>200,
                'message'=>'display last 4 online user',
                'data'=>$users,
                'last_seen'=>$last_seen,
                'online'=>$online
            ]);
        }
    }

    public function akses_user(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $userakses = DB::table('userakses')
            ->select('tanggal', DB::raw('count(*) as total'))
            ->groupBy('tanggal')
            ->get();

            $tanggal = [];
            $total   = [];
            foreach ($userakses as $key => $value) {
                # code...
                $tanggal[] = $value->tanggal;
                $total[] = $value->total;
            }

            return response()->json([
                'status'=>200,
                'message'=>'display total user akses',
                'tanggal'=>$tanggal,
                'total'=>$total
            ]);
        }
    }

    public function data_user_online(Request $request)
    {
        if ($request->ajax()) {
            # code...
            // $data = User::select("*")
            //         ->whereNotNull('last_seen')
            //         ->orderBy('last_seen', 'DESC')
            //         ->get();
            $tanggal = date('d-m-Y');
            $data = Userakses::whereHas('user',function($q)use($tanggal){
                $q->where('tanggal', $tanggal)->orderBy('last_seen','DESC');
            })->get();
            
            return DataTables::of($data)
            ->addColumn('username2',function($data){
                return $data->user->username;
            })
            ->addColumn('last_seen',function($data){
                return $last_seen[] = Carbon\Carbon::parse($data->last_seen)->diffForHumans();
            })
            ->addColumn('login_time',function($data){
                return Carbon\Carbon::parse($data->updated_at)->format('d-m-Y/H:i');
            })
            ->addColumn('online', function($data){
                if(Cache::has('user-is-online-' . $data->user->id)){
                    return 'online';
                }else {
                    # code...
                    return 'offline';
                }
            })
            ->rawColumns(['last_seen','online','username2','login_time'])
            ->make(true);
        }
    }

    public function data_user_akses(Request $request, $tanggal)
    {
        if ($request->ajax()) {
            # code...
            $tanggal = \Carbon\Carbon::parse($tanggal)->format('d-m-Y');
            $data = Userakses::where('tanggal',$tanggal)->get();

            return DataTables::of($data)
            ->addColumn('username2',function($data){
                return $data->user->username;
            })
            ->addColumn('login_time',function($data){
                return Carbon\Carbon::parse($data->updated_at)->format('d-m-Y/H:i');
            })
            ->rawColumns(['username2','login_time'])
            ->make(true);
        }
    }
}
