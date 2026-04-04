<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Akun YOTA HUB</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 8px; margin-top: 20px; border: 1px solid #e1e1e1; }
        .logo { text-align: center; margin-bottom: 30px; }
        .header { font-size: 24px; font-weight: bold; color: #1a202c; text-align: center; margin-bottom: 20px; }
        .content { font-size: 16px; color: #4a5568; line-height: 1.6; text-align: center; }
        .btn-container { text-align: center; margin-top: 35px; }
        .btn { background-color: #4f46e5; color: #ffffff !important; padding: 14px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #a0aec0; }
        .divider { border-top: 1px solid #edf2f7; margin: 30px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h2 style="color: #4f46e5; margin: 0;">YOTA HUB</h2>
            <small style="letter-spacing: 2px; color: #718096;">INNOVATION ECOSYSTEM</small>
        </div>

        <div class="header">Selamat Datang, {{ $name }}!</div>

        <div class="content">
            Terima kasih telah bergabung di <strong>YOTA HUB</strong>. Akun Anda telah terdaftar sebagai <strong>Basic Member (Layer 1)</strong>.
            Silakan konfirmasi alamat email Anda untuk mulai mengakses webinar, short course, dan artikel edukasi.
        </div>

        <div class="btn-container">
            <a href="{{ $url }}" class="btn">Verifikasi Email Saya</a>
        </div>

        <div class="divider"></div>

        <div class="content" style="font-size: 13px;">
            Jika tombol di atas tidak berfungsi, silakan salin dan tempel tautan berikut ke browser Anda: <br>
            <span style="color: #4f46e5; word-break: break-all;">{{ $url }}</span>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} PT Yota Inovasi Nusantara. <br>
            Pesan ini dikirim secara otomatis, mohon tidak membalas email ini.
        </div>
    </div>
</body>
</html>
