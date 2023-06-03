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
                <th>KODE</th>
                <th>JENIS</th>
                <th>VALUE</th>
                <th>JAWABAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($codes as $code)
                <tr>
                    <td rowspan="6">{{ $code }}</td>
                    <td>Soal</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>option</td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>option</td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>option</td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>option</td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>option</td>
                    <td></td>
                    <td>0</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>