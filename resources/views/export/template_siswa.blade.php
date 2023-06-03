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
                <th rowspan="3" colspan="3">TEMPLATE SISWA <br> <small>{{ $kelas->angkatan->tingkat->tingkat_name }} {{ $kelas->jurusan->jurusan_name }} {{ $kelas->kelas_name }} ({{ $kelas->angkatan->angkatan_name }})</small></th>
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
                <th rowspan="2" style="50px">NO</th>
                <th rowspan="2" style="width:200px">NIK</th>
                <th rowspan="2" style="width:300px">NAMA</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
        </tbody>
    </table>
</body>
</html>