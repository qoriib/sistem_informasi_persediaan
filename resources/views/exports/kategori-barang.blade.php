<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Kategori Sparepart</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 18px; margin: 0 0 6px 0; }
        .meta { font-size: 10px; color: #555; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; }
        th { background: #f1f5f9; text-align: left; }
    </style>
</head>
<body>
    <h1>Data Kategori Sparepart</h1>
    <div class="meta">Generated: {{ $generatedAt }}</div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @if($kategoriBarangs->isEmpty())
                <tr>
                    <td colspan="2">Tidak ada data kategori.</td>
                </tr>
            @else
                @foreach($kategoriBarangs as $index => $kategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->nama }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
