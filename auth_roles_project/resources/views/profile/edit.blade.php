@extends('layouts.app')

@section('content')

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    body {
        background: var(--crema);
    }

    .profile-container {
        max-width: 600px;
        margin: auto;
        padding: 40px 20px;
    }

    .profile-card {
        background: white;
        border-radius: 25px;
        padding: 30px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 2rem;
        margin-bottom: 20px;
        color: var(--texto);
    }

    label {
        font-weight: 700;
        font-size: 14px;
        display: block;
        margin-bottom: 5px;
        color: var(--texto);
    }

    input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 12px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        outline: none;
    }

    input:focus {
        border-color: var(--naranja);
    }

    .btn-primary {
        background: var(--naranja);
        color: white;
        padding: 10px 18px;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .alert-success {
        background: #e6ffed;
        color: #1a7f37;
        padding: 10px;
        border-radius: 12px;
        margin-bottom: 15px;
    }
</style>

<div class="profile-container">

    <div class="profile-card">

        <div class="title">👤 Editar Perfil</div>

        @if(session('status') === 'profile-updated')
            <div class="alert-success">
                Perfil actualizado correctamente 🐾
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

            <button type="submit" class="btn-primary">
                Guardar cambios
            </button>

        </form>

    </div>

</div>

@endsection