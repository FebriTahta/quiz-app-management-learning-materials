<?php

namespace App\Imports;

use App\Models\Optionmulti;
use App\Models\Soalmulti;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class QuizImport implements ToCollection
{

    private $ujianId;

    public function __construct($ujianId)
    {
        $this->ujianId = $ujianId;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $soal = [];
        try {
            foreach ($collection as $key => $row) {
                if ($key > 0) {
                    // input soal
                    if ($row[1] === 'Soal') {
                        $soal = [
                            'ujian_id' => $this->ujianId,
                            'soal_kode' => $row[0],
                            'soal_name' => $row[2],
                        ];
                        $soal = Soalmulti::create($soal);
                    }
                    // input opt
                    if ($row[1] === 'option') {
                        $opt = Optionmulti::create([
                            'soalmulti_id' => $soal->id, //$soal->id,
                            'option_name' => $row[2],
                            'option_true' => $row[3],
                        ]);
                    }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
