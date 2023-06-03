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
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="3" colspan="10">DATA URAIAN JAWABAN <br>
                    @php
                        $start = $jawaban->first();
                        $last  = $jawaban->last();
                    @endphp 
                    <small>
                        PERIODE : 
                        @if ($jawaban->count() > 0)
                        {{ \Carbon\Carbon::parse($start->examurai_datetimestart)->format('d F') }} - 
                        {{ \Carbon\Carbon::parse($last->examurai_datetimestart)->format('d F Y') }}
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
                <th rowspan="2" style="width:150px; background-color: gray; color: white">MATA_PELAJARAM</th>
                <th rowspan="2" style="width:150px; background-color: gray; color: white">JENIS_UJIAN</th>
                <th rowspan="2" style="width:400px; background-color: gray; color: white">SOAL_URAIAN</th>
                <th rowspan="2" style="width:500px; background-color: gray; color: white">JAWABAN_URAIAN</th>
                <th rowspan="2" style="width:80px; background-color: gray; color: white">NILAI</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            {{-- <tr  style="border: black"> --}}
               @foreach ($jawaban as $item)
                   <tr>
                        <td>
                            @if ($item->siswa !== null)
                                {{ $item->siswa->siswa_name }}
                            @endif
                        </td>
                        <td>{{ $item->examurai->mapel->mapel_name }}</td>
                        <td>{{ $item->examurai->examurai_jenis }}</td>
                        @if (Str::limit($item->soalexamurai->soalexam_name, 3) == 'be_...')
                            <td style="height: 100px;"></td>
                        @else
                            <td>
                                {{-- @php
                                    echo strip_tags(html_entity_decode($item->soalexamurai->soalexam_name))
                                @endphp --}}
                                {{ strip_tags($item->soalexamurai->soalexam_name) }}
                            </td>
                        @endif
                        <td>{{ strip_tags($item->jawabanku) }}</td>
                        <td>
                            @if ($item->nilaiku !== null)
                                {{ $item->nilaiku }}
                            @else
                                0
                            @endif
                            </td>
                   </tr>
               @endforeach
            {{-- </tr> --}}
        </tbody>
    </table>
</body>
</html>