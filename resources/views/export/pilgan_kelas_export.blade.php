<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .notel {
        mso-number-format: "\@";
        }
    </style>
</head>
<body>
    @if($jawaban !== null)
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="4" colspan="10">DATA HASIL PILIHAN GANDA. KELAS : 
                    @isset ($jawaban[0])
                    {{strtoupper($jawaban[0]->kelas->kelas_name)}} 
                    @endisset
                    <br>
                    @php
                        $start = $jawaban->first();
                        $last  = $jawaban->last();
                    @endphp 
                    <small>
                        PERIODE : 
                        @if ($jawaban->count() > 0)
                        {{ \Carbon\Carbon::parse($start->exam_datetimestart)->format('d F') }} - 
                        {{ \Carbon\Carbon::parse($last->examu_datetimeend)->format('d F Y') }}
                        @else
                        -
                        @endif
                    </small>
                </th>
            </tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead>
            <tr></tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead style="font-weight: bold; border: black">
            <tr style="border: black; text-transform: uppercase">
                <th rowspan="2" style="width:100px; background-color: gray; color: white">SISWA</th>
                @php
                    $mapels = [];
                    $siswas = [];
                    $nilais = [];
                    foreach ($jawaban as $key => $value) {
                        $mapels[] = $value->mapel->mapel_name;
                        $siswas[] = ''.$value->siswa->siswa_nik.'_'.strtoupper($value->siswa->siswa_name);
                        $nilais[''.$value->siswa->siswa_nik.'_'.strtoupper($value->siswa->siswa_name)][$value->mapel->mapel_name] = $value->nilai;
                    }
                    $mapel_unique = array_unique($mapels);
                    $siswa_unique = array_unique($siswas);
                @endphp
                @foreach ($mapel_unique as $key => $item)
                    <th style="width:150px; background-color: gray; color: white">MAPEL : {{$item}}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($mapel_unique as $key => $item)
                    <th style="width:75px; background-color: gray; color: white">Nilai</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa_unique as $key => $siswa)
                <tr>
                    <td>{{$siswa}}</td>
                    @foreach ($mapel_unique as $key => $mapel)
                        <td>{{ $nilais[$siswa][$mapel] ?? '' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>