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
        transform: translateY(-2px);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        margin-top: 15px;
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

    .table tbody tr:hover {
        background: #fff7f0;
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
        font-size: 13px;
        transition: .2s;
    }

    .btn-edit:hover,
    .btn-delete:hover {
        background: var(--naranja-suave);
        filter: brightness(0.95);
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    a {
        text-decoration: none;
    }
</style>

<div class="container-custom">

    <div class="card-custom">

        <div class="header">

            <div class="title">
                <i class="fa-solid fa-cart-shopping"></i>
                Compras
            </div>

            <a href="{{ route('compras.create') }}" class="btn-orange">
                <i class="fa-solid fa-plus"></i>
                Nueva Compra
            </a>

        </div>

        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            @foreach($compras as $compra)

                <tr>
                    <td>{{ $compra->Id_Com }}</td>

                    <td>{{ $compra->producto?->Nom_pro }}</td>

                    <td>{{ $compra->Cant_Com }}</td>

                    <td>
                        ${{ number_format($compra->Valor_Com, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($compra->Fecha_Com)->format('d/m/Y h:i A') }}
                    </td>

                    <td>
                        <div class="actions">

                            <a class="btn-edit" href="{{ route('compras.edit',$compra->Id_Com) }}">
                                Editar
                            </a>

                            <form action="{{ route('compras.destroy',$compra->Id_Com) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn-delete" onclick="return confirm('¿Eliminar compra?')">
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