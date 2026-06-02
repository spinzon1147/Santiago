<section class="verify-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .verify-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: var(--crema);
    }

    .card {
        background: white;
        max-width: 500px;
        width: 100%;
        padding: 30px;
        border-radius: 25px;
        border: 2px solid #FFD4B0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        text-align: center;
    }

    .title {
        font-family: 'Baloo 2', cursive;
        font-size: 1.6rem;
        margin-bottom: 10px;
        color: var(--texto);
    }

    .text {
        font-size: 14px;
        color: #7A4A1A;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .alert-success {
        color: #1a7f37;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .btn-primary {
        background: var(--naranja);
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 50px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .btn-link {
        background: none;
        border: none;
        color: #666;
        text-decoration: underline;
        cursor: pointer;
        font-size: 14px;
        margin-top: 15px;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>

<div class="card">

    <div class="title">📩 Verifica tu correo</div>

    <p class="text">
        Te hemos enviado un enlace de verificación.  
        Revisa tu correo antes de continuar 🐶
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert-success">
            Se envió un nuevo enlace de verificación ✔️
        </div>
    @endif

    <div class="actions">

        <!-- reenviar correo -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary">
                Reenviar correo
            </button>
        </form>

        <!-- logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-link">
                Cerrar sesión
            </button>
        </form>

    </div>

</div>

</section>