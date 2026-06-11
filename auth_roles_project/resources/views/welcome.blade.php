<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homero Pet Shop | Sistema de Gestión</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{
            font-family:'Inter',sans-serif;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(135deg,#f8fafc 0%,#fff7ed 50%,#f8fafc 100%);
            position:relative;
            overflow:hidden
        }
        .bg-orb{position:absolute;border-radius:50%;filter:blur(120px);opacity:.35}
        .bg-orb-1{width:500px;height:500px;background:#fb923c;top:-200px;left:-200px}
        .bg-orb-2{width:400px;height:400px;background:#f97316;bottom:-150px;right:-150px}
        .bg-orb-3{width:300px;height:300px;background:#fed7aa;top:50%;left:50%;transform:translate(-50%,-50%)}
        .card{
            position:relative;z-index:1;
            background:rgba(255,255,255,0.85);
            backdrop-filter:blur(24px);
            -webkit-backdrop-filter:blur(24px);
            border-radius:36px;padding:64px 52px;text-align:center;
            max-width:460px;width:100%;margin:20px;
            border:1px solid rgba(255,255,255,0.6);
            box-shadow:0 30px 80px rgba(0,0,0,0.06),0 10px 24px rgba(0,0,0,0.03)
        }
        .logo{
            width:100px;height:100px;margin:0 auto 28px;
            border-radius:24px;
            background:linear-gradient(135deg,#f97316,#ea580c);
            overflow:hidden;
            box-shadow:0 16px 40px rgba(249,115,22,0.3)
        }
        .logo img{width:100%;height:100%;object-fit:cover}
        .brand{color:#f97316;font-size:12px;font-weight:700;letter-spacing:3px;text-transform:uppercase;margin-bottom:14px}
        h1{color:#0f172a;font-size:36px;font-weight:800;line-height:1.12;margin-bottom:10px;letter-spacing:-0.5px}
        .subtitle{color:#64748b;font-size:15px;margin-bottom:38px;line-height:1.6}
        .btn{
            display:block;width:100%;
            padding:17px 24px;border-radius:18px;text-decoration:none;
            background:linear-gradient(135deg,#f97316,#ea580c);
            color:white;font-weight:600;font-size:15px;
            transition:all .25s ease;
            box-shadow:0 12px 30px rgba(249,115,22,0.3)
        }
        .btn:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(249,115,22,0.35)}
        .footer{margin-top:26px;font-size:12px;color:#94a3b8}
        @media(max-width:500px){
            .card{padding:40px 24px}
            h1{font-size:30px}
            .logo{width:80px;height:80px}
        }
    </style>
</head>
<body>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="card">
        <div class="logo">
            <img src="{{ asset('images/logo-homero.png') }}" alt="Homero Pet Shop">
        </div>
        <div class="brand">Homero Pet Shop</div>
        <h1>Sistema de Gestión</h1>
        <p class="subtitle">Inventario · Ventas · Compras · Clientes · Proveedores</p>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn">Ingresar al Sistema</a>
            @else
                <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
            @endauth
        @endif

        <div class="footer">Acceso restringido para personal autorizado</div>
    </div>
</body>
</html>
