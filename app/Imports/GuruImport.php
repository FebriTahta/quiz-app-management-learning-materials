<?php

namespace App\Imports;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuruImport implements ToCollection
{
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
                        'role'=>'guru'
                    ]
                );

                $usr = Guru::updateOrCreate(
                    [
                        'guru_nip'=> $row[1],
                        'guru_name' => $row[2],
                    ],
                    [
                        'user_id' => $usr->id,
                        'guru_nip'=> $row[1],
                        'guru_name'=> $row[2],
                        'guru_slug'=> Str::slug($row[2]),
                        'guru_status'=> 'aktif'
                    ]
                );
            }
        }
    }
}
