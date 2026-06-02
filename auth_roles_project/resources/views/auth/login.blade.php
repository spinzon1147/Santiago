<section class="login-section">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --naranja: #FF6B1A;
        --naranja-oscuro: #E85A0A;
        --crema: #FFF8F2;
        --texto: #2D1A00;
        --gris: #666;
        --borde: #E9E9E9;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .login-section {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to bottom right, #FFF8F2, #FFF1E5);
        padding: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        background: #fff;
        width: 100%;
        max-width: 430px;
        padding: 40px 35px;
        border-radius: 24px;
        border: 1px solid #f3d7c2;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
    }

    .title {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: var(--texto);
        margin-bottom: 8px;
        letter-spacing: -1px;
    }

    .subtitle {
        text-align: center;
        color: var(--gris);
        font-size: 14px;
        margin-bottom: 30px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid var(--borde);
        margin-bottom: 18px;
        outline: none;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: all .2s ease;
        background: #fff;
    }

    input::placeholder {
        color: #aaa;
    }

    input:focus {
        border-color: var(--naranja);
        box-shadow: 0 0 0 4px rgba(255,107,26,0.12);
    }

    .checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
        font-size: 14px;
        color: var(--gris);
    }

    .checkbox input {
        width: 16px;
        height: 16px;
        accent-color: var(--naranja);
    }

    .btn-primary {
        width: 100%;
        background: var(--naranja);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-primary:hover {
        background: var(--naranja-oscuro);
        transform: translateY(-1px);
    }

    .btn-primary:active {
        transform: scale(0.99);
    }

    .error {
        background: #fff1f1;
        border: 1px solid #ffd2d2;
        color: #d11a2a;
        padding: 12px 15px;
        border-radius: 14px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .error ul {
        padding-left: 18px;
    }

    .link {
        text-align: center;
        margin-top: 24px;
        font-size: 14px;
        color: var(--gris);
    }

    .link a {
        color: var(--naranja);
        text-decoration: none;
        font-weight: 600;
        transition: .2s;
    }

    .link a:hover {
        color: var(--naranja-oscuro);
    }

    @media (max-width: 480px) {
        .card {
            padding: 30px 25px;
        }

        .title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="card">

    <div class="title">
        Iniciar sesión
    </div>

    <div class="subtitle">
        Accede a tu cuenta para continuar
    </div>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL -->
        <label for="email">
            Correo electrónico
        </label>

        <input 
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="correo@ejemplo.com"
            required
            autofocus
        >

        <!-- PASSWORD -->
        <label for="password">
            Contraseña
        </label>

        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Ingresa tu contraseña"
            required
        >

        <!-- REMEMBER -->
        <div class="checkbox">
            <input type="checkbox" name="remember" id="remember">

            <label for="remember">
                Recordarme
            </label>
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn-primary">
            Ingresar
        </button>
    </form>

    <div class="link">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}">
            Crear cuenta
        </a>
    </div>

</div>

</section>