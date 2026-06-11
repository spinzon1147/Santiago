<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PataFeliz') }} &mdash; Homero Pet Shop</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-homero.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#f8fafc 0%,#fff7ed 50%,#f8fafc 100%);padding:16px 24px;position:relative;overflow:hidden}
        .orb{position:absolute;border-radius:50%;filter:blur(120px);opacity:.35}
        .orb-1{width:500px;height:500px;background:#fb923c;top:-200px;left:-200px}
        .orb-2{width:400px;height:400px;background:#f97316;bottom:-150px;right:-150px}
        .guest-wrap{width:100%;max-width:420px;position:relative;z-index:1}
        .guest-header{text-align:center;margin-bottom:32px}
        .guest-logo{display:inline-flex;align-items:center;justify-content:center;width:80px;height:80px;border-radius:20px;background:linear-gradient(135deg,#f97316,#ea580c);margin-bottom:16px;box-shadow:0 12px 32px rgba(249,115,22,0.3);overflow:hidden}
        .guest-logo img{width:100%;height:100%;object-fit:cover}
        .guest-card{background:#fff;border-radius:16px;border:1px solid #e2e8f0;padding:32px;box-shadow:0 4px 16px rgba(0,0,0,0.04)}
        .input{width:100%;padding:12px 16px;border:1px solid #e2e8f0;border-radius:12px;font-size:14px;background:#f8fafc;outline:none;transition:all 0.2s;font-family:'Inter',sans-serif}
        .input:focus{border-color:#f97316;background:#fff;box-shadow:0 0 0 3px rgba(249,115,22,0.1)}
        .input-label{display:block;font-size:14px;font-weight:600;color:#334155;margin-bottom:6px}
        .btn-primary{display:block;width:100%;padding:14px 24px;border-radius:12px;border:none;font-size:14px;font-weight:600;color:#fff;cursor:pointer;background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 8px 24px rgba(249,115,22,0.2);transition:all 0.2s ease;text-decoration:none;text-align:center}
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(249,115,22,0.3)}
        h2{font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px}
        .sub{font-size:14px;color:#94a3b8;margin-bottom:28px}
        .error-box{background:#fef2f2;border:1px solid #fecaca;border-radius:16px;padding:16px 20px;margin-bottom:20px;font-size:14px;color:#b91c1c;box-shadow:0 1px 3px rgba(0,0,0,0.04)}
        .error-box ul{padding-left:16px;margin:0}
        .error-box li{margin-bottom:4px}
        .error-box li:last-child{margin-bottom:0}
        .success-box{background:#ecfdf5;border:1px solid #a7f3d0;border-radius:16px;padding:16px 20px;margin-bottom:20px;font-size:14px;color:#047857;box-shadow:0 1px 3px rgba(0,0,0,0.04)}
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="guest-wrap">
        <div class="guest-header">
            <div class="guest-logo">
                <img src="{{ asset('images/logo-homero.png') }}" alt="Homero Pet Shop">
            </div>
            <h2 style="color:#0f172a;font-size:22px;font-weight:700">Homero Pet Shop</h2>
            <p style="color:#94a3b8;font-size:13px;margin-top:4px">Sistema de Gestión</p>
        </div>
        <div class="guest-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
