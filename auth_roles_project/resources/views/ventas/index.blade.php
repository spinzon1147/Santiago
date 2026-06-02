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
        color: white;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        overflow: hidden;
        border-radius: 15px;
    }

    .table thead {
        background: var(--naranja-suave);
    }

    .table th {
        text-align: left;
        padding: 14px;
        font-weight: 600;
        color: var(--texto);
        font-size: 14px;
    }

    .table td {
        padding: 14px;
        border-top: 1px solid #f3d7c2;
        color: var(--gris);
        font-size: 14px;
    }

    .table tbody tr:hover {
        background: #fff7f0;
    }

    .btn-edit {
        background: white;
        font-family: 'Poppins', sans-serif;
        color: var(--naranja);
        padding: 7px 14px;
        border: 2px solid #E85A0A;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: .2s;
    }

    .btn-edit:hover {
        filter: brightness(0.95);
        background: var(--naranja-suave);
    }

    .btn-delete {
        background: white;
        font-family: 'Poppins', sans-serif;
        border: 2px solid #E85A0A;
        color: var(--naranja);
        padding: 7px 14px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: .2s;
    }

    .btn-delete:hover {
        filter: brightness(0.9);
        background: var(--naranja-suave);
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .alert-success {
        border-radius: 15px;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="container-custom">

    <div class="card-custom">

        <div class="header">

            <div class="title">
                <i class="fa-solid fa-cash-register"></i>
                Ventas
            </div>

            <a href="{{ route('ventas.create') }}" class="btn-orange">
                <i class="fa-solid fa-plus"></i>
                Nueva Venta
            </a>

        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            @foreach($ventas as $venta)

                <tr>

                    <td>{{ $venta->Id_Ven }}</td>
                    <td>{{ $venta->Valor_Ven }}</td>
                    <td>{{ $venta->Fecha_Ven }}</td>
                    <td>{{ $venta->Cant_Ven }}</td>

                    <td>

                        <div class="actions">

                            <a href="{{ route('ventas.edit',$venta->Id_Ven) }}" class="btn-edit">
                                Editar
                            </a>

                            <form action="{{ route('ventas.destroy',$venta->Id_Ven) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('¿Eliminar esta venta?')">
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