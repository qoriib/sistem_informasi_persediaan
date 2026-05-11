<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Pembelian</title>
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
    <h1>Data Pembelian</h1>
    <div class="meta">Generated: {{ $generatedAt }}</div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th>Tanggal</th>
                <th>User</th>
                <th class="text-right">Total Item</th>
            </tr>
        </thead>
        <tbody>
            @if($pembelians->isEmpty())
                <tr>
                    <td colspan="4">Tidak ada data pembelian.</td>
                </tr>
            @else
                @foreach($pembelians as $index => $pembelian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembelian->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $pembelian->user->name ?? '-' }}</td>
                        <td class="text-right">{{ $pembelian->details->sum('jumlah') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
