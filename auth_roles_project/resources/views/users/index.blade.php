@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --naranja-suave: #FFF0E6;
        --crema: #FFF8F2;
        --texto: #2D1A00;
        --gris: #666;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #FFF8F2, #FFF1E5);
    }

    .users-container {
        max-width: 1100px;
        margin: auto;
        padding: 60px 20px;
    }

    .users-card {
        background: #fff;
        border-radius: 28px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
        border: 1px solid #f3d7c2;
    }

    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .users-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--texto);
        letter-spacing: -0.5px;
    }

    .users-title span {
        color: var(--naranja);
    }

    .btn-orange {
        background: var(--naranja);
        color: white;
        border: none;
        padding: 12px 22px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: .2s;
    }

    .btn-orange:hover {
        background: var(--naranja-oscuro);
        transform: translateY(-1px);
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    thead {
        background: var(--naranja-suave);
    }

    th, td {
        padding: 14px;
        text-align: left;
        font-size: 14px;
    }

    th {
        color: var(--texto);
        font-weight: 600;
    }

    td {
        color: var(--gris);
        border-bottom: 1px solid #eee;
    }

    tr:hover {
        background: #fff7f2;
    }

    .btn-edit {
        background: #FFC107;
        color: black;
        border: none;
        padding: 7px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-delete {
        background: #DC3545;
        color: white;
        border: none;
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .alert-success {
        background: #e9ffe9;
        border: 1px solid #b7f5b7;
        color: #1f7a1f;
        padding: 12px 15px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    @media(max-width: 768px) {
        .users-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

</style>

<div class="users-container">

    <div class="users-card">

        <div class="users-header">

            <h1 class="users-title">
                <span>Usuarios</span> del sistema
            </h1>

            <a href="{{ route('users.create') }}" class="btn-orange">
                + Nuevo usuario
            </a>

        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($users as $user)
                    <tr>

                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'Sin rol' }}</td>

                        <td>

                            <a href="{{ route('users.edit', $user) }}" class="btn-edit">
                                Editar
                            </a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button 
                                    type="submit" 
                                    class="btn-delete"
                                    onclick="return confirm('¿Eliminar este usuario?')"
                                >
                                    Eliminar
                                </button>

                            </form>

                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection