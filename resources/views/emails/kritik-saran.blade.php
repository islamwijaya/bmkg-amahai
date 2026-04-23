<!DOCTYPE html>
<html>
<head>
    <title>Kritik & Saran Baru</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px;">
        <h2 style="color: #003366; border-bottom: 2px solid #C9A227; padding-bottom: 10px;">Kritik & Saran Baru</h2>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 150px;">Nama:</td>
                <td style="padding: 8px 0;">{{ $data['nama'] ?? 'Anonim' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Email:</td>
                <td style="padding: 8px 0;">{{ $data['email'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Jenis Masukan:</td>
                <td style="padding: 8px 0; text-transform: capitalize;">{{ $data['jenis'] }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Aspek:</td>
                <td style="padding: 8px 0;">{{ $data['aspek'] }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Rating:</td>
                <td style="padding: 8px 0;">{{ $data['rating'] }} / 5</td>
            </tr>
        </table>

        <div style="margin-top: 20px; padding: 15px; bg-color: #f9f9f9; border-left: 4px solid #003366;">
            <p style="margin: 0; font-weight: bold;">Pesan:</p>
            <p style="white-space: pre-wrap;">{{ $data['pesan'] }}</p>
        </div>

        <p style="font-size: 12px; color: #888; margin-top: 30px; text-align: center;">
            Email ini dikirim secara otomatis dari sistem website Stasiun Meteorologi Amahai.
        </p>
    </div>
</body>
</html>
