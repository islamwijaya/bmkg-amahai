<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Baru</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333 text-align: left;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px;">
        <h2 style="color: #b91c1c; border-bottom: 2px solid #C9A227; padding-bottom: 10px;">Pengaduan Baru [{{ $pengaduan->nomor_tiket }}]</h2>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 150px;">Nama:</td>
                <td style="padding: 8px 0;">{{ $pengaduan->nama }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">NIK:</td>
                <td style="padding: 8px 0;">{{ $pengaduan->nik }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Email:</td>
                <td style="padding: 8px 0;">{{ $pengaduan->email }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Telepon:</td>
                <td style="padding: 8px 0;">{{ $pengaduan->telepon }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Kategori:</td>
                <td style="padding: 8px 0;">{{ $pengaduan->kategori }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Judul:</td>
                <td style="padding: 8px 0;">{{ $pengaduan->judul }}</td>
            </tr>
        </table>

        <div style="margin-top: 20px; padding: 15px; bg-color: #fff5f5; border-left: 4px solid #b91c1c;">
            <p style="margin: 0; font-weight: bold;">Isi Pengaduan:</p>
            <p style="white-space: pre-wrap;">{{ $pengaduan->isi }}</p>
        </div>

        <p style="font-size: 12px; color: #888; margin-top: 30px; text-align: center;">
            Email ini dikirim secara otomatis dari sistem website Stasiun Meteorologi Amahai.
        </p>
    </div>
</body>
</html>
