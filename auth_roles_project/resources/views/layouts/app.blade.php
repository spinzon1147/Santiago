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
            color: var(--texto);
        }

        main {
            min-height: calc(100vh - 70px);
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    @include('layouts.navbar')

    <!-- CONTENIDO -->
    <main>
        @yield('content')
    </main>

</body>

</html>