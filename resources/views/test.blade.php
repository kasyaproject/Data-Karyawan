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

    <p>Hasil atas: {{ $defuzzyfikasi_numerator }} </p>
    <p>Hasil bawah: {{ $defuzzyfikasi_denominator }} </p>
    <p>Hasil pembagian: {{ $defuzzyfikasi }} </p>
    @foreach($hasil as $him => $nilaiA)
        <p>{{ $him }}: {{ $nilaiA }}</p>
    @endforeach
    <p>Hasil Akhir: {{ $himTerbesar }} dengan point {{ $nilaiTerbesar }}</p>
</body>
</html>
