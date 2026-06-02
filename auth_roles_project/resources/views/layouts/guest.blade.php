<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PataFeliz') }}</title>

    <style>
        :root {
            --naranja: #FF6B1A;
            --naranja-oscuro: #E85A0A;
            --crema: #FFF8F2;
            --texto: #2D1A00;
        }

        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: var(--crema);
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            flex-direction: column;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo a {
            text-decoration: none;
            font-family: 'Baloo 2', cursive;
            font-size: 2rem;
            font-weight: 800;
            color: var(--naranja);
        }

        .card {
            background: white;
            width: 100%;
            max-width: 450px;
            border-radius: 25px;
            padding: 30px;
            border: 2px solid #FFD4B0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        @media(max-width: 500px) {
            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <!-- LOGO -->
        <div class="logo">
            <a href="/">
                🐶 {{ config('app.name', 'PataFeliz') }}
            </a>
        </div>

        <!-- CARD -->
        <div class="card">
            {{ $slot }}
        </div>

    </div>

</body>

</html>