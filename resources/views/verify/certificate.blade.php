<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Piagam - YOTA HUB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            max-width: 560px;
            width: 100%;
            text-align: center;
            box-shadow: 0 40px 100px rgba(0,0,0,0.4);
        }
        .badge-valid {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 32px;
        }
        .badge-valid.valid { background: #f0fdf4; color: #15803d; border: 1.5px solid #a3e635; }
        .badge-valid.invalid { background: #fef2f2; color: #dc2626; border: 1.5px solid #fca5a5; }

        .icon { font-size: 64px; margin-bottom: 20px; }
        h1 { font-size: 28px; font-weight: 900; color: #0f172a; margin-bottom: 8px; }
        .subtitle { color: #94a3b8; font-size: 14px; margin-bottom: 32px; }

        .info-grid { background: #f8fafc; border-radius: 16px; padding: 24px; text-align: left; margin-bottom: 28px; }
        .info-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 0; border-bottom: 1px solid #e2e8f0; }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; }
        .info-value { font-size: 14px; font-weight: 700; color: #0f172a; text-align: right; max-width: 220px; }

        .code-box {
            background: #0f172a;
            color: #a3e635;
            font-family: monospace;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.3em;
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .footer-note { font-size: 12px; color: #94a3b8; }
        .footer-note strong { color: #65a30d; }

        .btn { display: inline-block; padding: 14px 32px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; margin-top: 16px; }
        .btn-primary { background: #0f172a; color: white; }
        .btn-primary:hover { background: #1e293b; }
    </style>
</head>
<body>
    <div class="card">
        @if($record)
            <div class="badge-valid valid">✅ Piagam Terverifikasi</div>
            <div class="icon">🏆</div>
            <h1>Piagam Resmi & Valid</h1>
            <p class="subtitle">Piagam ini telah diverifikasi dan diterbitkan resmi oleh YOTA HUB Innovation Platform.</p>

            <div class="info-grid">
                <div class="info-row">
                    <span class="info-label">Nama Penerima</span>
                    <span class="info-value">{{ $user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Program Diselesaikan</span>
                    <span class="info-value">{{ $module->title }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nilai Akhir</span>
                    <span class="info-value" style="color:#15803d;">{{ $record->quiz_score }} / 100</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Terbit</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($record->certificate_issued_at)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Diterbitkan Oleh</span>
                    <span class="info-value">YOTA HUB Innovation</span>
                </div>
            </div>

            <div class="code-box">{{ $code }}</div>

            <a href="{{ route('member.certificate.download', $code) }}" class="btn btn-primary" target="_blank">
                📥 Lihat & Unduh Piagam
            </a>

            <p class="footer-note" style="margin-top: 16px;">
                Dokumen ini dapat digunakan sebagai bukti sah penyelesaian program pembelajaran<br>
                <strong>YOTA HUB Innovation Platform — Layer 1: Knowledge Program</strong>
            </p>

        @else
            <div class="badge-valid invalid">❌ Tidak Ditemukan</div>
            <div class="icon">🔍</div>
            <h1>Piagam Tidak Valid</h1>
            <p class="subtitle">Kode yang Anda scan tidak ditemukan dalam sistem kami.<br>Pastikan QR Code dipindai dengan benar.</p>

            <div class="code-box" style="color:#fca5a5;">{{ $code }}</div>

            <p class="footer-note">
                Jika Anda merasa ini adalah kesalahan, silakan hubungi<br>
                <strong>tim administrasi YOTA HUB Innovation.</strong>
            </p>
        @endif
    </div>
</body>
</html>
