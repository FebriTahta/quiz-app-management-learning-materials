<?php

namespace Database\Seeders;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\Angkatan;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            [
                'jurusan_name' => 'RPL',
                'jurusan_slug' => Str::slug('rpl'),
            ],
            [
                'jurusan_name' => 'Akuntansi Perkantoran',
                'jurusan_slug' => Str::slug('akuntansi-perkantoran'),
            ],
            [
                'jurusan_name' => 'Teknik Jaringan',
                'jurusan_slug' => Str::slug('teknik-jaringan'),
            ],
            [
                'jurusan_name' => 'Tata Boga',
                'jurusan_slug' => Str::slug('tata-boga'),
            ]
        ];

        $cek_jurusan = Jurusan::where('jurusan_slug','rpl')
                                ->orWhere('jurusan_slug','akuntansi-perkantoran')
                                ->orWhere('jurusan_slug','teknik-jaringan')
                                ->orWhere('jurusan_slug','tata-boga')
                                ->first();
        if ($cek_jurusan == null) {
            # code...
            Jurusan::insert($jurusan);
        }

        $tingkat = [
            [
                'tingkat_name' => 'X',
            ],
            [
                'jurusan_name' => 'XI',
            ],
            [
                'jurusan_name' => 'XII',
            ],
        ];

        $cek_tingkat = Tingkat::where('tingkat_name','X')
                                ->orWhere('tingkat_name','XI')
                                ->orWhere('tingkat_name','XII')
                                ->first();
        if ($cek_tingkat == null) {
            # code...
            Tingkat::insert($tingkat);
        }

        // $kelas = [
        //     [
        //         'tingkat_id' => 1,
        //         'jurusan_id' => 1,
        //         'kelas_name' => '1',
        //     ],
        //     [
        //         'tingkat_id' => 1,
        //         'jurusan_id' => 1,
        //         'kelas_name' => '2',
        //     ],
        //     [
        //         'tingkat_id' => 1,
        //         'jurusan_id' => 2,
        //         'kelas_name' => '1'
        //     ],
        //     [
        //         'tingkat_id' => 1,
        //         'jurusan_id' => 2,
        //         'kelas_name' => '2'
        //     ],
        //     [
        //         'tingkat_id' => 2,
        //         'jurusan_id' => 2,
        //         'kelas_name' => '1'
        //     ],
        //     [
        //         'tingkat_id' => 2,
        //         'jurusan_id' => 2,
        //         'kelas_name' => '2'
        //     ],
        //     [
        //         'tingkat_id' => 1,
        //         'jurusan_id' => 3,
        //         'kelas_name' => '1'
        //     ],
        // ];

        // Kelas::insert($kelas);
        

        // $angkatan = [
        //     [
        //         'kelas_id' => 1,
        //         'jurusan_id' => 1,
        //         'angkatan_name' => 2022,
        //         'angkatan_status' => 'aktif'
        //     ],
        // ];

        // $cek_angkatan = Angkatan::where('kelas_id',1)->where('jurusan_id',1)->where('angkatan_name',2022)->first();
        // if ($cek_angkatan == null) {
        //     # code...
        //     Angkatan::insert($angkatan);
        // }

        // $user = [
        //     'username' => 'tahta',
        //     'role' => 'siswa',
        //     'pass' => '12356',
        //     'password' => bcrypt("123456"),
        // ];

        // $cek_user = User::where('pass','123456')->first();
        // if ($cek_user == null) {
        //     # code...
        //     User::insert($user);
        // }

        // $siswa = [
        //     'user_id' => 2,
        //     'jurusan_id' => 1,
        //     'kelas_id' => 2,
        //     'siswa_nik' => 123456,
        //     'siswa_name' => 'tahta',
        //     'siswa_slug' => Str::slug('tahta'),
        //     'siswa_status' => 'aktif',
        //     'siswa_angkatan' => '2022',
        // ];

        // $cek_siswa = Siswa::where('siswa_nik','123456')->first();
        // if ($cek_siswa == null) {
        //     # code...
        //     Siswa::insert($siswa);
        // }
    }
}
