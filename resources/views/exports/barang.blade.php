<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Sparepart</title>
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
    <h1>Data Sparepart</h1>
    <div class="meta">Generated: {{ $generatedAt }}</div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th class="text-right">Stok</th>
                <th class="text-right">ROP</th>
            </tr>
        </thead>
        <tbody>
            @if($barangs->isEmpty())
                <tr>
                    <td colspan="6">Tidak ada data sparepart.</td>
                </tr>
            @else
                @foreach($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->kode }}</td>
                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->kategori->nama ?? '-' }}</td>
                        <td class="text-right">{{ $barang->stok }}</td>
                        <td class="text-right">{{ $barang->rop }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
