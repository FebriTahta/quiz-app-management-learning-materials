<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Angkatan;
use Illuminate\Support\Str;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function daftar_user(Request $request)
    {  
        if ($request->ajax()) {
            # code...
            $data = User::get();
            return DataTables::of($data)
            ->addColumn('opsi',function($data){
               $btn =  '<button class="btn btn-xs btn-primary" data-id="'.$data->id.'"
               data-username="'.$data->username.'" data-pass="'.$data->pass.'" data-role="'.$data->role.'"
               data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="icon icon-edit"></i></button>';
               $btn .= ' <button class="btn btn-xs btn-danger"
               data-toggle="modal" data-target="#modaldel" data-id="'.$data->id.'"><i style="margin-left: 15px" class="icon icon-trash"></i></button>';
               return $btn;
            })
            ->rawColumns(['opsi'])
            ->make(true); 
        }
        $total_user = User::count();
        $angkatan = Angkatan::get();
        $kelas = Kelas::with(['angkatan','jurusan'])->get();
        return view('be_page.user',compact('total_user','angkatan','kelas'));
    }

    public function user_baru(Request $request)
    {
        if ($request->userbaru == 'userguru') {
            # code...
            $validator = Validator::make($request->all(), [
                'guru_name'       => 'required',
                'guru_nip'       => 'required',
            ]);
    
            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages(),
                ]);
            } else {

                DB::beginTransaction();

                try {
                    $usr = new User;
                    $usr->username = $request->guru_name;
                    $usr->pass = $request->guru_nip;
                    $usr->password = Hash::make($request->guru_nip);
                    $usr->role = 'guru';
                    $usr->save();
    
                    $gur = DB::table('gurus')->insert(
                        [
                            'user_id' => $usr->id,
                            'guru_nip'=> $request->guru_nip,
                            'guru_name'=> $request->guru_name,
                            'guru_slug'=> Str::slug($request->guru_name),
                            'guru_status'=> 'aktif'
                        ]
                    );
                    
                    DB::commit();
                    return response()->json([
                        'status'=> 200,
                        'message'=> 'Guru baru berhasil didaftarkan'
                    ]);

                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'status'=> 400,
                        'message'=> 'Galat input'
                    ]);
                }
                
            }
        }else {
            # code...
            $validator = Validator::make($request->all(), [
                'siswa_name'       => 'required',
                'siswa_nik'       => 'required',
                'angkatan_id'       => 'required',
            ]);
    
            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages(),
                ]);
            } else {

                DB::beginTransaction();
                try {
                    $usr = new User;
                    $usr->username = $request->siswa_name;
                    $usr->pass = $request->siswa_nik;
                    $usr->password = Hash::make($request->siswa_nik);
                    $usr->role = 'siswa';
                    $usr->save();
    
                    $sis = DB::table('siswas')->insert(
                        [
                            'user_id' => $usr->id,
                            'siswa_nik'=> $request->siswa_nik,
                            'siswa_name'=> $request->siswa_name,
                            'angkatan_id'=> $request->angkatan_id,
                            'siswa_slug'=> Str::slug($request->siswa_name),
                            'siswa_status'=> 'aktif'
                        ]
                    );
    
                    DB::commit();
                    return response()->json([
                        'status'=> 200,
                        'message'=> 'Siswa baru berhasil didaftarkan'
                        // .$usr->id.'-'
                        // .$request->siswa_nik.'-'
                        // .$request->angkatan_id.'-'
                        // .$request->siswa_name
                    ]);

                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'status'=> 400,
                        'message'=> 'Galat input'
                    ]);
                }
            }
        }
    }

    public function update_user(Request $request)
    {
        $data = User::updateOrCreate(
            ['id'=> $request->id],
            [
                'username' => $request->username,
                'pass' => $request->pass,
                'role' => $request->role,
                'password' => Hash::make($request->pass),
            ]
        );

        return response()->json(['status'=>200,'message'=>'Data user telah diperbarui']);
    }

    public function hapus_user(Request $request)
    {
        $data = User::where('id', $request->id)->first();
        if ($data->guru) {
            # code...
            Guru::where('user_id', $data->id)->delete();
        }

        if ($data->siswa) {
            # code...
            Siswa::where('user_id', $data->id)->delete();
        }

        if ($data) {
            # code...
            $data->delete();
        }

        return response()->json(['status'=>200,'message'=>'Data user telah dihapus']);
    }

    public function ubah_password(Request $request)
    {
        $id = $request->user_id;
        $data = User::where('id', $id)->update(
            [
                'username' => $request->username,
                'pass'     => $request->pass,
                'password' => Hash::make($request->pass),

            ]
        );

        return response()->json(
            [
                'status' => 200,
                'message' => 'credential users has been updated',
            ]
        );
    }
}
