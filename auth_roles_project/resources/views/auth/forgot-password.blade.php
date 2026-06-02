<section class="forgot-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .forgot-section {
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
        max-width: 450px;
        padding: 30px;
        border-radius: 25px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.6rem;
        text-align: center;
        margin-bottom: 10px;
        color: var(--texto);
    }

    .text {
        font-size: 14px;
        color: #7A4A1A;
        line-height: 1.6;
        margin-bottom: 20px;
        text-align: center;
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

    .alert {
        font-size: 13px;
        color: #1a7f37;
        margin-bottom: 10px;
        text-align: center;
    }

    .error {
        color: red;
        font-size: 13px;
        margin-top: -10px;
        margin-bottom: 10px;
    }
</style>

<div class="card">

    <div class="title">🔐 Recuperar contraseña</div>

    <p class="text">
        ¿Olvidaste tu contraseña?  
        Escribe tu correo y te enviaremos un enlace para restablecerla 🐶
    </p>

    <!-- STATUS -->
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- EMAIL -->
        <label>Correo electrónico</label>
        <input 
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
        >

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-primary">
            Enviar enlace de recuperación 🐾
        </button>

    </form>

</div>

</section>