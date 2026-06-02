<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homero Pet Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        :root{
            --naranja: #FF6B1A;
            --naranja-oscuro: #E85A0A;
            --crema: #FFF8F2;
            --texto: #2D1A00;
            --gris: #666;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: linear-gradient(135deg, #FFF8F2, #FFF1E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container{
            background: white;
            padding: 45px 35px;
            width: 380px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 10px 35px rgba(0,0,0,0.08);
            border: 1px solid #f3d7c2;
        }

        h1{
            margin-bottom: 10px;
            color: var(--texto);
            font-size: 1.8rem;
            letter-spacing: -0.5px;
        }

        h1 span{
            color: var(--naranja);
        }

        p{
            margin-bottom: 30px;
            color: var(--gris);
            font-size: 14px;
        }

        .btn{
            display: block;
            width: 100%;
            padding: 14px;
            margin-bottom: 12px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            font-size: 14px;
        }

        .login{
            background: var(--naranja);
            color: white;
        }

        .login:hover{
            background: var(--naranja-oscuro);
            transform: translateY(-1px);
        }

        .register{
            background: #fff;
            color: var(--texto);
            border: 1px solid #eee;
        }

        .register:hover{
            background: var(--crema);
            border-color: #f3d7c2;
            color: var(--naranja);
        }

    </style>
</head>
<body>

    <div class="container">

        <h1><span>Homero</span> Pet Shop</h1>

        <p>Sistema interno para empleados y administrador</p>

        @if (Route::has('login'))

            @auth

                <a href="{{ url('/dashboard') }}" class="btn login">
                    Ir al Dashboard
                </a>

            @else

                <a href="{{ route('login') }}" class="btn login">
                    Iniciar Sesión
                </a>

                @if (Route::has('register'))

                    <a href="{{ route('register') }}" class="btn register">
                        Registrarse
                    </a>

                @endif

            @endauth

        @endif

    </div>

</body>
</html>