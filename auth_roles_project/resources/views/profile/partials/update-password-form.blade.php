<section class="password-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .password-section {
        max-width: 650px;
        margin: auto;
        padding: 40px 20px;
    }

    .password-card {
        background: white;
        border-radius: 25px;
        padding: 30px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.8rem;
        color: var(--texto);
        margin-bottom: 5px;
    }

    .subtitle {
        font-size: 14px;
        color: #7A4A1A;
        margin-bottom: 20px;
    }

    label {
        font-weight: 700;
        font-size: 14px;
        display: block;
        margin-bottom: 5px;
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
        font-size: 13px;
        color: #1a7f37;
        margin-top: 10px;
    }
</style>

<div class="password-card">

    <div class="title">🔒 Cambiar contraseña</div>

    <p class="subtitle">
        Usa una contraseña segura para proteger tu cuenta.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <label>Contraseña actual</label>
        <input 
            type="password"
            name="current_password"
            autocomplete="current-password"
        >

        @error('current_password', 'updatePassword')
            <p style="color:red; font-size:13px;">{{ $message }}</p>
        @enderror

        <label>Nueva contraseña</label>
        <input 
            type="password"
            name="password"
            autocomplete="new-password"
        >

        @error('password', 'updatePassword')
            <p style="color:red; font-size:13px;">{{ $message }}</p>
        @enderror

        <label>Confirmar contraseña</label>
        <input 
            type="password"
            name="password_confirmation"
            autocomplete="new-password"
        >

        @error('password_confirmation', 'updatePassword')
            <p style="color:red; font-size:13px;">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn-primary">
            Guardar cambios
        </button>

        @if (session('status') === 'password-updated')
            <p class="alert-success">
                Contraseña actualizada correctamente 🐾
            </p>
        @endif

    </form>

</div>

</section>