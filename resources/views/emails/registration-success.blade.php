<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin-bottom: 30px; }
        .footer { text-align: center; font-size: 12px; color: #777; }
        .info-box { background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #4f46e5; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pendaftaran Berhasil!</h2>
        </div>
        <div class="content">
            <p>Assalamu'alaikum Wr. Wb. <strong>{{ $santri->nama_lengkap }}</strong>,</p>
            <p>Terima kasih telah mendaftar di Pesantren Al-Kautsar. Pendaftaran Anda telah kami terima.</p>
            
            <div class="info-box">
                <p><strong>Detail Pendaftaran:</strong></p>
                <p>Nomor Pendaftaran: <strong>{{ $santri->nomor_pendaftaran }}</strong></p>
                <p>Status: <strong>Pending (Menunggu Verifikasi)</strong></p>
            </div>

            <p>Silakan simpan nomor pendaftaran di atas untuk mengecek status pendaftaran Anda secara berkala di website kami.</p>
            
            <p>Anda juga dapat login ke dashboard santri menggunakan:</p>
            <ul>
                <li>Username: {{ $santri->email }} (atau Nomor Pendaftaran)</li>
                <li>Password: <em>santri123</em> (default)</li>
            </ul>

            <div style="text-align: center;">
                <a href="{{ route('status.check') }}" class="btn">Cek Status Sekarang</a>
            </div>
        </div>
        <div class="footer">
            <p>Pesan ini dikirim secara otomatis oleh sistem pendaftaran Pesantren Al-Kautsar.</p>
            <p>&copy; {{ date('Y') }} Pesantren Al-Kautsar</p>
        </div>
    </div>
</body>
</html>
