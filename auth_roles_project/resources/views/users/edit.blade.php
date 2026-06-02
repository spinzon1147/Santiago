@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
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

    .edit-container {
        max-width: 750px;
        margin: auto;
        padding: 60px 20px;
    }

    .edit-card {
        background: #fff;
        border-radius: 28px;
        padding: 40px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
    }

    .title {
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--texto);
        margin-bottom: 25px;
        letter-spacing: -0.5px;
    }

    .title span {
        color: var(--naranja);
    }

    label {
        font-weight: 600;
        font-size: 14px;
        color: var(--texto);
        margin-bottom: 6px;
        display: block;
    }

    input, select {
        width: 100%;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #e5e5e5;
        margin-bottom: 18px;
        outline: none;
        font-size: 14px;
        transition: .2s;
        background: #fff;
    }

    input:focus, select:focus {
        border-color: var(--naranja);
        box-shadow: 0 0 0 4px rgba(255,107,26,0.12);
    }

    .btn-primary {
        background: var(--naranja);
        color: white;
        padding: 12px 22px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
        transition: .2s;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #fff;
        color: var(--texto);
        padding: 12px 22px;
        border-radius: 50px;
        border: 1px solid #eee;
        text-decoration: none;
        margin-left: 10px;
        display: inline-block;
        font-size: 14px;
        transition: .2s;
    }

    .btn-secondary:hover {
        background: var(--crema);
        color: var(--naranja);
        border-color: #f3d7c2;
    }

    .error-box {
        background: #fff1f1;
        border: 1px solid #ffd2d2;
        color: #b00020;
        padding: 12px 15px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 18px;
    }

    @media(max-width: 768px) {
        .edit-card {
            padding: 30px 20px;
        }
    }

</style>

<div class="edit-container">

    <div class="edit-card">

        <div class="title">
            <span>Editar</span> Usuario
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

            <label>Contraseña (opcional)</label>
            <input type="password" name="password">

            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation">

            <label>Rol</label>
            <select name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn-primary">
                Actualizar
            </button>

            <a href="{{ route('users.index') }}" class="btn-secondary">
                Cancelar
            </a>

        </form>

    </div>

</div>

@endsection