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

    body {
        background: linear-gradient(to bottom right, #FFF8F2, #FFF1E5);
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 40px 20px;
    }

    .form-card {
        width: 100%;
        max-width: 600px;
        background: #fff;
        border-radius: 28px;
        padding: 40px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
    }

    .title {
        text-align: center;
        font-size: 26px;
        font-weight: 700;
        color: var(--texto);
        margin-bottom: 30px;
    }

    .title i {
        color: var(--naranja);
        margin-right: 8px;
    }

    label {
        display: block;
        margin-top: 15px;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--texto);
    }

    input {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #f3d7c2;
        font-size: 15px;
        outline: none;
        transition: .2s;
        font-family: 'Poppins', sans-serif;
    }

    input:focus {
        border-color: var(--naranja);
        box-shadow: 0 0 0 3px rgba(255,107,26,.15);
    }

    .alert-success {
        background: #e6ffed;
        color: #1a7f37;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 600;
    }

    .buttons {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }

    .btn-primary {
        flex: 1;
        background: var(--naranja);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .btn-secondary {
        flex: 1;
        background: #f1f1f1;
        color: #444;
        padding: 14px;
        border-radius: 50px;
        text-decoration: none;
        text-align: center;
        font-weight: 600;
        transition: .2s;
    }

    .btn-secondary:hover {
        background: #e3e3e3;
    }

    .info-box {
        background: var(--naranja-suave);
        border-radius: 15px;
        padding: 18px;
        margin-bottom: 20px;
        text-align: center;
        color: var(--texto);
    }

    .info-box i {
        color: var(--naranja);
        font-size: 30px;
        margin-bottom: 10px;
    }
</style>

<div class="form-container">

    <div class="form-card">

        <div class="title">
            <i class="fa-solid fa-user-pen"></i>
            Editar Perfil
        </div>

        @if(session('status') === 'profile-updated')
            <div class="alert-success">
                ✅ Perfil actualizado correctamente
            </div>
        @endif

        <div class="info-box">
            <i class="fa-solid fa-user"></i>
            <p>Actualiza tu información personal.</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <label>Nombre</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required>

            <label>Correo Electrónico</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required>

            <div class="buttons">

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Guardar Cambios
                </button>

                <a href="{{ url()->previous() }}" class="btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

@endsection