<section class="register-section">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
    }

    .register-section {
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
        margin-bottom: 20px;
        text-align: center;
        color: var(--texto);
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
        margin-top: 10px;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
    }

    .error {
        color: red;
        font-size: 13px;
        margin-top: -10px;
        margin-bottom: 10px;
    }
</style>

<div class="card">

    <div class="title">🐶 Crear cuenta en PataFeliz</div>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAME -->
        <label>Nombre</label>
        <input 
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
            autofocus
        >

        <!-- EMAIL -->
        <label>Correo electrónico</label>
        <input 
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        <!-- PASSWORD -->
        <label>Contraseña</label>
        <input 
            type="password"
            name="password"
            required
        >

        <!-- CONFIRM -->
        <label>Confirmar contraseña</label>
        <input 
            type="password"
            name="password_confirmation"
            required
        >

        <button type="submit" class="btn-primary">
            Registrarme 🐾
        </button>

    </form>

</div>

</section>