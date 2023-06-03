<?php

namespace App\Imports;
use App\Models\Soalexamurai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExamuraiImport implements ToCollection
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
                if ($key >= 6) {
                    // input soal
                    $soal = [
                        'examurai_id' => $this->ujianId,
                        'soalexam_name' => $row[1],
                    ];
                    $soal = Soalexamurai::create($soal);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
