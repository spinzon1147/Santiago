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
        --gris: #666;
    }

    body {
        background: linear-gradient(to bottom right, #FFF8F2, #FFF1E5);
        font-family: 'Poppins', sans-serif;
    }

    .container-custom {
        max-width: 600px;
        margin: auto;
        padding: 50px 20px;
    }

    .card-custom {
        background: #fff;
        border-radius: 28px;
        padding: 30px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
    }

    .title {
        font-size: 26px;
        font-weight: 700;
        color: var(--texto);
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .title i {
        color: var(--naranja);
    }

    label {
        display: block;
        margin-top: 15px;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 14px;
        color: var(--texto);
    }

    input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #f3d7c2;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        outline: none;
        transition: .2s;
    }

    input:focus {
        border-color: var(--naranja);
        box-shadow: 0 0 0 3px rgba(255,107,26,0.15);
    }

    .btn-primary {
        margin-top: 20px;
        width: 100%;
        background: var(--naranja);
        color: white;
        padding: 12px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: .2s;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
        transform: translateY(-2px);
    }
</style>

<div class="container-custom">
    <div class="card-custom">

        <div class="title">
            <i class="fa-solid fa-cart-shopping"></i>
            Actualizar Compra
        </div>

        <form action="{{ route('compras.update',$compra->Id_Com) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Valor Compra</label>
            <input type="number" name="Valor_Com" value="{{ $compra->Valor_Com }}">

            <label>Fecha</label>
            <input type="date" name="Fecha_Com" value="{{ $compra->Fecha_Com }}">

            <label>Cantidad</label>
            <input type="number" name="Cant_Com" value="{{ $compra->Cant_Com }}">

            <button type="submit" class="btn-primary">
                Actualizar
            </button>

        </form>

    </div>
</div>

@endsection