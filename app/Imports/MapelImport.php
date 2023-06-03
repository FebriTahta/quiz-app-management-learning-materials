<?php

namespace App\Imports;
use Illuminate\Support\Str;
use App\Models\Mapel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MapelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 6) {
                $mapel = Mapel::where('mapel_name', $row[1])->first();
                if ($mapel == null) {
                    # code...
                    $map = new Mapel;
                    $map->mapel_name = $row[1];
                    $map->mapel_slug = Str::slug($row[1]);
                    $map->save();
                }
            }
        }
    }
}
