@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --naranja-suave: #FFF0E6;
        --crema: #FFF8F2;
        --texto: #2D1A00;
        --gris: #666;
    }

    body {
        background: linear-gradient(to bottom right, #FFF8F2, #FFF1E5);
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        max-width: 650px;
        margin: auto;
        padding: 50px 20px;
    }

    .form-card {
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
        font-weight: 600;
        font-size: 14px;
        display: block;
        margin-bottom: 6px;
        margin-top: 15px;
        color: var(--texto);
    }

    input, select {
        width: 100%;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #f3d7c2;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        transition: .2s;
        background: #fff;
    }

    input:focus, select:focus {
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

    .btn-secondary {
        display: inline-block;
        margin-top: 12px;
        width: 100%;
        text-align: center;
        background: #fff;
        color: var(--gris);
        padding: 12px;
        border-radius: 50px;
        text-decoration: none;
        border: 1px solid #ddd;
        font-weight: 600;
        transition: .2s;
    }

    .btn-secondary:hover {
        background: #f5f5f5;
    }
</style>

<div class="form-container">

    <div class="form-card">

        <div class="title">
            <i class="fa-solid fa-cart-shopping"></i>
            Registrar Compra
        </div>

        <form action="{{ route('compras.store') }}" method="POST">
            @csrf

            <label>Producto</label>
            <select name="Id_Prod_FK" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->Id_pro }}">
                        {{ $producto->Nom_pro }}
                    </option>
                @endforeach
            </select>

            <label>Cantidad</label>
            <input type="number" name="Cant_Com" required>

            <label>Fecha</label>
            <input type="datetime-local" name="Fecha_Com" required>

            <label>Valor de la compra</label>
            <input type="number" name="Valor_Com" required>

            <button type="submit" class="btn-primary">
                Guardar Compra
            </button>

            <a href="{{ route('compras.index') }}" class="btn-secondary">
                Cancelar
            </a>

        </form>

    </div>

</div>

@endsection