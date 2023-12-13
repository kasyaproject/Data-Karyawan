<!DOCTYPE html>
<html>
<head>
    <title>Show Grafik</title>
</head>
<body>
    <h1>FUZZYFIKASI</h1>
    @foreach ($fuzzyfikasi as $jenis => $grafik)
        <h3>Jenis: {{ $jenis }}</h3>
        <ul>
            @foreach ($grafik as $item)
                <li>Nilai a: {{ $item['a'] }}, Jenis Tipe: {{ $item['him'] }}</li>
            @endforeach
        </ul>
    @endforeach

    <h1>INFERENSI</h1>
    
    <table>
        <thead>
            <tr>
                <th>Penilaian</th>
                <th>Kerajinan</th>
                <th>Kelebihan</th>
                <th>Kekurangan</th>
                <th>Output</th>
                <th>Min</th>
                <th>Z</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inferensi as $data)
                <tr>
                    <td>{{ $data['penilaian']['him'] }}</td>
                    <td>{{ $data['kerajinan']['him'] }}</td>
                    <td>{{ $data['kelebihan']['him'] }}</td>
                    <td>{{ $data['kekurangan']['him'] }}</td>
                    <td>{{ $data['rule']['output'] }}</td>
                    <td>{{ $data['minProbabilitas'] }}</td>
                    <td>{{ $data['z'] }}</td>
                    <td>{{ $data['a'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>DEFFUZYFIKASI</h1>

    <p>Hasil defuzzyfikasi: {{ $hasil }} / {{ $nilai }}</p>
    <p>Pembagian biasa: {{ $pembagian }}</p>
</body>
</html>
