<section class="confirm-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .confirm-section {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: var(--crema);
        padding: 20px;
    }

    .card {
        background: white;
        width: 100%;
        max-width: 420px;
        padding: 30px;
        border-radius: 25px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        text-align: center;
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: var(--texto);
    }

    .text {
        font-size: 14px;
        color: #7A4A1A;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    label {
        font-weight: 700;
        font-size: 14px;
        display: block;
        text-align: left;
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
        width: 100%;
        background: var(--naranja);
        color: white;
        padding: 12px;
        border-radius: 50px;
        border: none;
        font-weight: 800;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .error {
        color: red;
        font-size: 13px;
        margin-top: -10px;
        margin-bottom: 10px;
        text-align: left;
    }
</style>

<div class="card">

    <div class="title">🔐 Confirmar contraseña</div>

    <p class="text">
        Esta es una zona segura.  
        Por favor confirma tu contraseña para continuar 🐶
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- PASSWORD -->
        <label>Contraseña</label>
        <input 
            type="password"
            name="password"
            required
            autocomplete="current-password"
        >

        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-primary">
            Confirmar
        </button>

    </form>

</div>

</section>
