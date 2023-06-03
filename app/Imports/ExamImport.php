<?php

namespace App\Imports;
use App\Models\Optionexam;
use App\Models\Soalexam;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExamImport implements ToCollection
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
                            'exam_id' => $this->ujianId,
                            'soalexam_kode' => $row[0],
                            'soalexam_name' => $row[2],
                        ];
                        $soal = Soalexam::create($soal);
                    }
                    // input opt
                    if ($row[1] === 'option') {
                        $opt = Optionexam::create([
                            'soalexam_id' => $soal->id, //$soal->id,
                            'optionexam_name' => $row[2],
                            'optionexam_true' => $row[3],
                        ]);
                    }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
