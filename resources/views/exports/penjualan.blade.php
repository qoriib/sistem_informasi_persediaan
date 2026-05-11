<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Penjualan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 18px; margin: 0 0 6px 0; }
        .meta { font-size: 10px; color: #555; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; }
        th { background: #f1f5f9; text-align: left; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1>Data Penjualan</h1>
    <div class="meta">Generated: {{ $generatedAt }}</div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th>Tanggal</th>
                <th>Kode Sparepart</th>
                <th>Nama Sparepart</th>
                <th class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @if($penjualans->isEmpty())
                <tr>
                    <td colspan="5">Tidak ada data penjualan.</td>
                </tr>
            @else
                @foreach($penjualans as $penjualan)
                    @foreach($penjualan->details as $detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $detail->barang->kode ?? '-' }}</td>
                            <td>{{ $detail->barang->nama ?? '-' }}</td>
                            <td class="text-right">{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
