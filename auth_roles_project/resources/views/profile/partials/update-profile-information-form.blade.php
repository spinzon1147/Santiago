<section class="profile-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .profile-section {
        max-width: 650px;
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

    .text-small {
        font-size: 13px;
        color: #666;
    }

    .alert-success {
        color: #1a7f37;
        font-size: 13px;
        margin-top: 8px;
    }

    .alert-warning {
        font-size: 13px;
        color: #b45309;
        margin-top: 10px;
    }
</style>

<div class="profile-card">

    <div class="title">👤 Información del perfil</div>

    <p class="subtitle">
        Actualiza tu nombre y correo electrónico de tu cuenta.
    </p>

    <!-- Form verificación -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form principal -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <label>Nombre</label>
        <input 
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            required
        >

        <label>Email</label>
        <input 
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            required
        >

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <p class="text-small">
                Tu correo no está verificado.

                <button form="send-verification" class="text-small" style="text-decoration: underline;">
                    Reenviar correo de verificación
                </button>
            </p>

            @if (session('status') === 'verification-link-sent')
                <p class="alert-success">
                    Se envió un nuevo enlace de verificación 🐾
                </p>
            @endif

        @endif

        <button type="submit" class="btn-primary">
            Guardar cambios
        </button>

        @if (session('status') === 'profile-updated')
            <p class="alert-success">Guardado correctamente 🧡</p>
        @endif

    </form>

</div>

</section>