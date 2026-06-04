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
        max-width: 1100px;
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

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .title {
        font-size: 28px;
        font-weight: 700;
        color: var(--texto);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .title i {
        color: var(--naranja);
    }

    .btn-orange {
        background: var(--naranja);
        color: white;
        padding: 12px 22px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: .2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-orange:hover {
        background: var(--naranja-oscuro);
        color: white;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    .table thead {
        background: var(--naranja-suave);
    }

    .table th {
        padding: 14px;
        text-align: left;
        color: var(--texto);
    }

    .table td {
        padding: 14px;
        border-top: 1px solid #f3d7c2;
    }

    .btn-edit,
    .btn-delete {
        background: white;
        border: 2px solid #E85A0A;
        color: var(--naranja);
        padding: 7px 14px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .actions {
        display: flex;
        gap: 10px;
    }
</style>

<div class="container-custom">

    <div class="card-custom">

        <div class="header">

            <div class="title">
                <i class="fa-solid fa-box"></i>
                Productos
            </div>

            <a href="{{ route('productos.create') }}" class="btn-orange">
                <i class="fa-solid fa-plus"></i>
                Nuevo Producto
            </a>

        </div>


        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($productos as $producto)

                <tr>

                    <td>{{ $producto->Id_pro }}</td>
                    <td>{{ $producto->Nom_pro }}</td>
                    <td>{{ $producto->Cant_pro }}</td>
                    <td>{{ $producto->Estado_pro }}</td>
                    <td>${{ number_format($producto->Precio_pro, 0, ',', '.') }}</td>
                    <td>{{ $producto->Descrip_pro }}</td>

                    <td>

                        <div class="actions">

                            <a href="{{ route('productos.edit',$producto->Id_pro) }}" class="btn-edit">
                                Editar
                            </a>

                            <form action="{{ route('productos.destroy',$producto->Id_pro) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn-delete" onclick="return confirm('¿Eliminar producto?')">
                                    Eliminar
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection