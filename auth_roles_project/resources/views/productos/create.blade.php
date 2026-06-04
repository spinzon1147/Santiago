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

    .container-custom {
        max-width: 800px;
        margin: auto;
        padding: 50px 20px;
    }

    .card-custom {
        background: #fff;
        border-radius: 28px;
        padding: 35px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
    }

    .title {
        font-size: 28px;
        font-weight: 700;
        color: var(--texto);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .title i {
        color: var(--naranja);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--texto);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e5d1c2;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        outline: none;
        transition: .2s;
    }

    .form-control:focus {
        border-color: var(--naranja);
        box-shadow: 0 0 0 3px rgba(255,107,26,0.15);
    }

    .btn-orange {
        background: var(--naranja);
        color: white;
        border: none;
        padding: 12px 22px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .btn-orange:hover {
        background: var(--naranja-oscuro);
        color: white;
    }

    .btn-secondary {
        background: white;
        color: var(--naranja);
        border: 2px solid var(--naranja);
        padding: 10px 22px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        }

    .buttons {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .alert-danger {
        background: #ffe5e5;
        color: #b30000;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
</style>

<div class="container-custom">


<div class="card-custom">

    <div class="title">
        <i class="fa-solid fa-plus"></i>
        Crear Producto
    </div>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label class="form-label">Nombre</label>
            <input type="text"
                   name="Nom_pro"
                   class="form-control"
                   value="{{ old('Nom_pro') }}"
                   required>
        </div>

        <div class="form-group">
            <label class="form-label">Cantidad</label>
            <input type="number"
                   name="Cant_pro"
                   class="form-control"
                   value="{{ old('Cant_pro') }}"
                   required>
        </div>

        <div class="form-group">
    <label class="form-label">Precio</label>
    <input type="number"
           name="Precio_pro"
           class="form-control"
           value="{{ old('Precio_pro') }}"
           step="0.01"
           min="0"
           required>
</div>

        <div class="form-group">
            <label class="form-label">Estado</label>
            <select name="Estado_pro" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Descripción</label>
            <textarea
    name="Descrip_pro"
    class="form-control"
    rows="4"
    required>{{ old('Descrip_pro') }}</textarea>
        </div>

        <div class="buttons">

            <button type="submit" class="btn-orange">
                Guardar Producto
            </button>

            <a href="{{ route('productos.index') }}" class="btn-secondary">
                Volver
            </a>

        </div>

    </form>

</div>


</div>

@endsection
