<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piagam - {{ $user->name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .certificate-wrapper {
            width: 900px;
            position: relative;
        }

        .certificate {
            background: white;
            border: 2px solid #a3e635;
            padding: 60px 70px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.12);
        }

        /* Ornamen pojok */
        .certificate::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            border: 8px solid transparent;
            border-image: linear-gradient(135deg, #a3e635 0%, #84cc16 50%, #a3e635 100%) 1;
            pointer-events: none;
        }

        .corner-tl, .corner-tr, .corner-bl, .corner-br {
            position: absolute;
            width: 50px;
            height: 50px;
            border-color: #a3e635;
            border-style: solid;
        }
        .corner-tl { top: 12px; left: 12px; border-width: 3px 0 0 3px; }
        .corner-tr { top: 12px; right: 12px; border-width: 3px 3px 0 0; }
        .corner-bl { bottom: 12px; left: 12px; border-width: 0 0 3px 3px; }
        .corner-br { bottom: 12px; right: 12px; border-width: 0 3px 3px 0; }

        /* Background subtle */
        .bg-pattern {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(163,230,53,0.04) 0%, transparent 70%);
            pointer-events: none;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .company-name {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: #65a30d;
            margin-bottom: 4px;
        }

        .cert-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
            margin: 16px 0;
        }

        .cert-subtitle {
            font-size: 13px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 600;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 32px 0;
        }
        .divider-line { flex: 1; height: 1px; background: linear-gradient(to right, transparent, #a3e635, transparent); }
        .divider-star { color: #a3e635; font-size: 20px; }

        .presented-to {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .recipient-name {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 900;
            color: #0f172a;
            text-align: center;
            margin-bottom: 8px;
        }

        .recipient-detail {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        .body-text {
            text-align: center;
            color: #475569;
            font-size: 15px;
            line-height: 1.8;
            margin: 28px 60px;
        }

        .program-name {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            display: inline-block;
            border-bottom: 2px solid #a3e635;
            padding-bottom: 4px;
        }

        .grade-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 16px auto;
            padding: 10px 28px;
            background: #f0fdf4;
            border: 1.5px solid #a3e635;
            border-radius: 50px;
            font-weight: 700;
            color: #15803d;
            font-size: 16px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px dashed #e2e8f0;
        }

        .signature-block { text-align: center; }
        .signature-name { font-weight: 700; font-size: 14px; color: #0f172a; margin-top: 40px; }
        .signature-title { font-size: 12px; color: #94a3b8; }
        .signature-line { width: 160px; height: 1px; background: #94a3b8; margin: 8px auto 0; }

        .qr-block { text-align: center; }
        .qr-block img { width: 100px; height: 100px; }
        .qr-label { font-size: 10px; color: #94a3b8; margin-top: 6px; letter-spacing: 0.1em; }
        .cert-code { font-size: 10px; font-weight: 700; color: #64748b; font-family: monospace; letter-spacing: 0.2em; }

        .date-block { text-align: center; }
        .date-label { font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; }
        .date-value { font-weight: 700; color: #0f172a; font-size: 14px; margin-top: 4px; }

        /* Print CSS */
        @media print {
            body { background: white; padding: 0; }
            .no-print { display: none !important; }
            .certificate { box-shadow: none; }
        }
    </style>
</head>
<body>

    {{-- Tombol Download (tidak muncul saat print) --}}
    <div class="no-print" style="position:fixed; top:20px; right:20px; z-index:999; display:flex; gap:10px;">
        <button onclick="window.print()"
                style="padding:12px 24px; background:#0f172a; color:white; font-family:'Inter',sans-serif; font-weight:700; font-size:13px; letter-spacing:0.1em; text-transform:uppercase; border:none; border-radius:12px; cursor:pointer; box-shadow:0 4px 16px rgba(0,0,0,0.2);">
            📥 Unduh / Print PDF
        </button>
        <a href="{{ route('certificate.verify', $code) }}"
           style="padding:12px 24px; background:#a3e635; color:#0f172a; font-family:'Inter',sans-serif; font-weight:700; font-size:13px; letter-spacing:0.1em; text-transform:uppercase; border:none; border-radius:12px; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center;">
            🔍 Verifikasi Piagam
        </a>
    </div>

    <div class="certificate-wrapper">
        <div class="certificate">
            <div class="corner-tl"></div>
            <div class="corner-tr"></div>
            <div class="corner-bl"></div>
            <div class="corner-br"></div>
            <div class="bg-pattern"></div>

            {{-- Header --}}
            <div class="header">
                <div class="company-name">YOTA HUB Innovation Platform</div>
                <div class="cert-title">PIAGAM</div>
                <div class="cert-subtitle">Certificate of Completion · Layer 1 Knowledge</div>
            </div>

            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-star">✦</div>
                <div class="divider-line"></div>
            </div>

            {{-- Penerima --}}
            <div class="presented-to">Diberikan kepada</div>
            <div class="recipient-name">{{ $user->name }}</div>
            <div class="recipient-detail">{{ $user->email }}</div>

            {{-- Isi Piagam --}}
            <div class="body-text">
                Telah berhasil menyelesaikan program pembelajaran<br>
                <span class="program-name">{{ $module->title }}</span><br>
                dalam Platform E-Learning YOTA HUB Innovation — Layer 1: Knowledge Program<br>
                dengan dedikasi dan komitmen yang luar biasa.
            </div>

            <div style="text-align:center;">
                <div class="grade-badge">
                    🎯 Nilai Akhir: <strong>{{ $record->quiz_score }} / 100</strong>
                </div>
            </div>

            {{-- Footer --}}
            <div class="footer">
                {{-- Tanggal --}}
                <div class="date-block">
                    <div class="date-label">Diterbitkan pada</div>
                    <div class="date-value">{{ \Carbon\Carbon::parse($record->certificate_issued_at)->format('d F Y') }}</div>
                </div>

                {{-- QR Code --}}
                <div class="qr-block">
                    @php
                        $verifyUrl = route('certificate.verify', $code);
                        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' . urlencode($verifyUrl);
                    @endphp
                    <img src="{{ $qrUrl }}" alt="QR Verifikasi">
                    <div class="qr-label">Scan untuk verifikasi</div>
                    <div class="cert-code">{{ $code }}</div>
                </div>

                {{-- Tanda Tangan --}}
                <div class="signature-block">
                    <div class="signature-name">Tim YOTA HUB</div>
                    <div class="signature-line"></div>
                    <div class="signature-title" style="margin-top:4px;">Program Director</div>
                    <div class="signature-title">YOTA HUB Innovation</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
