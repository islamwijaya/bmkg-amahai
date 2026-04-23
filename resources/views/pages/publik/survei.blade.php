@php
    $bulan = (int) date('m');
    $tahun = date('Y');
    $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);
    $semester = ($bulan <= 6) ? 1 : 2;

    $url = "https://eskm.bmkg.go.id/survey/289182/0/{$semester}/{$tahun}-{$bulanFormatted}/{$tahun}/0";

    header("Location: {$url}");
    exit;
@endphp
