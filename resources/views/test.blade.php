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
                <th>Absensi</th>
                <th>Kerajinan</th>
                <th>Kelebihan</th>
                <th>Output</th>
                <th>Min</th>
                <th>Z</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inferensi as $data)
                <tr>
                    <td>{{ $data['rule']['absensi'] }}</td>
                    <td>{{ $data['rule']['produktif'] }}</td>
                    <td>{{ $data['rule']['custrelation'] }}</td>
                    <td>{{ $data['rule']['keputusan'] }}</td>
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
    <p>Hasil Deffuzyfikasi: {{ $defuzzyfikasi }} </p>
    <p>==============================================================</p>
    @foreach($hasil as $him => $nilaiA)
        <p>{{ $him }}: {{ $nilaiA }}</p>
    @endforeach
    <p>Hasil Akhir : <label class="text-base font-semibold">{{ $himTerbesar }}</label> dengan point {{ $nilaiTerbesar }}</p>
</body>
</html>
