<?php

namespace App\Http\Controllers;
use Validator;
use DataTables;
use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    public function admin_angkatan(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Angkatan::orderBy('angkatan_name','desc')->with('tingkat')->get();
            return DataTables::of($data)
            ->addColumn('opsi',function($data){
                return $btn = '<button class="btn btn-xs btn-info" data-target="#modaledit" data-toggle="modal"
                data-id="'.$data->id.'" data-angkatan_name="'.$data->angkatan_name.'"><i class="icon icon-edit" style="margin-left:15px"></i></button>';
            })
            ->addColumn('tingkatan', function($data){
                $exist = $data->tingkat;
                if ($exist) {
                    # code...
                    return $data->tingkat->tingkat_name;
                }else {
                    # code...
                    return 'kosong';
                }
            })
            ->rawColumns(['opsi'])
            ->make(true);
        }

        return view('be_page.angkatan');
    }

    public function total_angkatan()
    {
        $total = Angkatan::count();
        return response()->json([
            'status' => 200,
            'message' => 'menampilkan total angkatan',
            'total' => $total,
        ]);
    }

    public function post_angkatan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'angkatan_name' => 'required',
            'tingkat_id' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()
            ]);
        }else {
            # code...
            $exist = Angkatan::where('angkatan_name', $request->angkatan_name)
                             ->where('tingkat_id', $request->tingkat_id)->first();
            if ($exist) {
                # code...
                if ($request->id == $exist->id) {
                    # code...
                    $data = Angkatan::updateOrCreate(
                        [
                            'id' => $request->id,
                        ],
                        [
                            'angkatan_name' => $request->angkatan_name,
                            'tingkat_id' => $request->tingkat_id,
                            'angkatan_status' => 'aktif',
                        ]
                    );
    
                    return response()->json([
                        'status' => 200,
                        'message' => 'angkatan baru berhasil ditambahakan'
                    ]);

                }else {
                    # code...
                    return response()->json([
                        'status' => 400,
                        'message' => ['tahun angkatan sudah terdaftar']
                    ]);
                }
            }else {
                # code...
                $data = Angkatan::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'angkatan_name' => $request->angkatan_name,
                        'tingkat_id' => $request->tingkat_id,
                        'angkatan_status' => 'aktif',
                    ]
                );

                return response()->json([
                    'status' => 200,
                    'message' => 'angkatan baru berhasil ditambahakan'
                ]);
            }
            
        }
    }

    public function remove_angkatan()
    {

    }
}
