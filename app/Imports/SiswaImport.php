<?php

namespace App\Imports;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    public function __construct($kelas)
    {
        $this->kelas=$kelas;
        // $this->angkatan_id = Kelas::where('id',$this->kelas->id)->select('angkatan_id')->first();
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 6) {
                    $usr = User::updateOrCreate(
                        [
                            'username'=> $row[2],
                            'pass'=> $row[1],
                        ],
                        [
                            'username' => $row[2],
                            'pass'=> $row[1],
                            'password'=> Hash::make($row[1]),
                            'role'=>'siswa'
                        ]
                    );

                    $sis = Siswa::updateOrCreate(
                        [
                            'siswa_nik'=> $row[1],
                            'siswa_name'=> $row[2],
                        ],
                        [
                            'user_id' => $usr->id,
                            'kelas_id' => $this->kelas->id,
                            'angkatan_id' => $this->kelas->angkatan->id,
                            'siswa_nik' => $row[1],
                            'siswa_name' => $row[2],
                            'siswa_slug' => Str::slug($row[2]),
                            'siswa_status' => 'aktif',
                        ]
                    );
            }
        }
    }
}
