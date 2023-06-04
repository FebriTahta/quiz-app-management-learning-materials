<?php

namespace Database\Seeders;
use App\Models\Hari;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hari = [
            [
                'hari_ind' => 'minggu',
                'hari_eng' => 'sunday'
            ],
            [
                'hari_ind' => 'senin',
                'hari_eng' => 'monday'
            ],
            [
                'hari_ind' => 'selasa',
                'hari_eng' => 'tuesday'
            ],
            [
                'hari_ind' => 'rabu',
                'hari_eng' => 'webnesday'
            ],
            [
                'hari_ind' => 'kamis',
                'hari_eng' => 'thursday'
            ],
            [
                'hari_ind' => 'jumat',
                'hari_eng' => 'friday'
            ],
            [
                'hari_ind' => 'sabtu',
                'hari_eng' => 'saturday'
            ],
        ];

        $cek_hari = Hari::where('hari_ind', 'senin')->orWhere('hari_ind','selasa')->orWhere('hari_ind','rabu')
        ->orWhere('hari_ind','kamis')->orWhere('hari_ind','jumat')->orWhere('hari_ind','sabtu')->orWhere('hari_ind','minggu')->first();

        if ($cek_hari == null) {
            # code...
            Hari::insert($hari);
        }
    }
}
