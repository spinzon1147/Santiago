@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --naranja-suave: #FFF0E6;
        --texto: #2D1A00;
        --crema: #FFF8F2;
        --gris: #666;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(to bottom right, #FFF8F2, #FFF1E5);
        font-family: 'Poppins', sans-serif;
    }

    .dashboard {
        max-width: 1100px;
        margin: auto;
        padding: 60px 20px;
    }

    .welcome-card {
        background: #fff;
        border-radius: 28px;
        padding: 55px 45px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-circle {
        width: 90px;
        height: 90px;
        background: var(--naranja-suave);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 25px;
    }

    .logo-circle i {
        color: var(--naranja);
        font-size: 40px;
    }

    .welcome-card h1 {
        color: var(--texto);
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 12px;
        letter-spacing: -1px;
    }

    .welcome-card h1 span {
        color: var(--naranja);
    }

    .welcome-card p {
        color: var(--gris);
        font-size: 15px;
        line-height: 1.6;
    }

    .modulos {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }

    .card-modulo {
        background: #fff;
        border-radius: 24px;
        padding: 35px 25px;
        text-align: center;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
        transition: all .25s ease;
    }

    .card-modulo:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(255,107,26,0.15);
    }

    .icono {
        width: 80px;
        height: 80px;
        background: var(--naranja-suave);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .icono i {
        color: var(--naranja);
        font-size: 32px;
    }

    .card-modulo h2 {
        color: var(--texto);
        margin: 20px 0 10px;
        font-size: 1.4rem;
    }

    .card-modulo p {
        color: var(--gris);
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    .btn-orange {
        display: inline-block;
        background: var(--naranja);
        color: white;
        padding: 14px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all .2s ease;
    }

    .btn-orange:hover {
        background: var(--naranja-oscuro);
        color: white;
        transform: translateY(-2px);
    }

    .btn-orange:active {
        transform: scale(0.98);
    }

    @media (max-width: 768px) {
        .welcome-card {
            padding: 40px 25px;
        }

        .welcome-card h1 {
            font-size: 2rem;
        }

        .welcome-card p {
            font-size: 14px;
        }
    }
</style>

<div class="dashboard">

    <div class="welcome-card">

        <div class="logo-circle">
            <i class="fa-solid fa-paw"></i>
        </div>

        <h1>
            Hola, <span>{{ Auth::user()->name }}</span>
        </h1>

        <p>
            Bienvenido a Homero Pet Shop.
            Desde aquí podrás gestionar compras, ventas y toda la información de tu tienda.
        </p>

    </div>

    <div class="modulos">

        <div class="card-modulo">

            <div class="icono">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <h2>Módulo Compras</h2>

            <p>
                Registrar y administrar compras de productos para mantener actualizado el inventario.
            </p>

            <a href="{{ route('compras.index') }}" class="btn-orange">
                Entrar
            </a>

        </div>

        <div class="card-modulo">

            <div class="icono">
                <i class="fa-solid fa-cash-register"></i>
            </div>

            <h2>Módulo Ventas</h2>

            <p>
                Registrar y administrar ventas realizadas y controlar los movimientos comerciales.
            </p>

            <a href="{{ route('ventas.index') }}" class="btn-orange">
                Entrar
            </a>

        </div>

        <div class="card-modulo">

    <div class="icono">
        <i class="fa-solid fa-box"></i>
    </div>

    <h2>Módulo Productos</h2>

    <p>
        Registrar, actualizar y administrar los productos disponibles en la tienda y controlar el stock.
    </p>

    <a href="{{ route('productos.index') }}" class="btn-orange">
        Entrar
    </a>

</div>

    </div>

</div>

@endsection