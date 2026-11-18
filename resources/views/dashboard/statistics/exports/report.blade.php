<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #1f2937; }
        .header { border-bottom: 2px solid #0f766e; padding-bottom: 10px; margin-bottom: 18px; }
        h1 { color: #0f766e; font-size: 18px; margin: 0 0 5px; }
        h2 { color: #0f766e; font-size: 14px; margin: 18px 0 8px; }
        .meta { color: #4b5563; font-size: 9px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        th { background: #ecfdf5; color: #115e59; }
        th, td { border: 1px solid #d1d5db; padding: 6px; text-align: left; }
        td.total, th.total { text-align: right; }
        .number { text-align: right; }
        .footer { margin-top: 20px; border-top: 1px solid #d1d5db; padding-top: 8px; color: #6b7280; font-size: 8px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Statistik Desa</h1>
        <div class="meta">
            <strong>{{ $villageSetting->village_name ?? 'Desa Cantik' }}</strong>
            @if ($rw || $rt)
                <br>Filter: {{ $rw ? 'RW ' . $rw : 'Semua RW' }}{{ $rt ? ' / RT ' . $rt : '' }}
            @else
                <br>Filter: Semua wilayah
            @endif
            <br>Tanggal cetak: {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    @foreach ($reports as $index => $report)
        @if ($index > 0)<div class="page-break"></div>@endif
        <h2>{{ $report['module'] }} - {{ $report['title'] }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th class="number">Laki-laki</th>
                    <th class="number">Perempuan</th>
                    <th class="number">Total</th>
                    <th class="number">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report['rows'] as $row)
                    <tr>
                        <td>{{ $row['category'] }}</td>
                        <td class="number">{{ $row['male'] !== null ? number_format($row['male'], 0, ',', '.') : '-' }}</td>
                        <td class="number">{{ $row['female'] !== null ? number_format($row['female'], 0, ',', '.') : '-' }}</td>
                        <td class="number">{{ number_format($row['total'], 0, ',', '.') }}</td>
                        <td class="number">{{ number_format($row['percent'], 1, ',', '.') }}%</td>
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th class="number">{{ number_format($report['total'], 0, ',', '.') }}</th>
                    <th></th>
                </tr>
            </tbody>
        </table>
    @endforeach

    <div class="footer">Laporan ini dibuat otomatis oleh sistem Desa Cantik berdasarkan data agregat.</div>
</body>
</html>
