<nav class="nav">

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
    }

    .nav {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid #f3d7c2;
        padding: 15px 24px;
        position: sticky;
        top: 0;
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
    }

    .nav-container {
        max-width: 1150px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    /* BRAND */

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--texto);
        transition: .2s;
    }

    .brand:hover {
        opacity: .9;
    }

    .brand-text {
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .brand-text span {
        color: var(--naranja);
    }

    /* LINKS */

    .links {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

    .links a {
        text-decoration: none;
        color: var(--texto);
        font-size: 14px;
        font-weight: 500;
        transition: .2s;
        padding: 8px 12px;
        border-radius: 10px;
    }

    .links a:hover {
        color: var(--naranja);
        background: var(--crema);
    }

    /* ADMIN BADGE */

    .admin-link {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .admin-badge {
        background: var(--naranja);
        color: white;
        font-size: 10px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    /* BUTTON */

    .btn-logout {
        background: var(--naranja);
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: .2s;
    }

    .btn-logout:hover {
        background: var(--naranja-oscuro);
        transform: translateY(-1px);
    }

    .btn-logout:active {
        transform: scale(0.98);
    }

    /* MOBILE */

    @media(max-width: 768px) {

        .nav-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .links {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
            margin-top: 10px;
        }

        .links a {
            width: 100%;
        }

        .btn-logout {
            width: 100%;
        }
    }
</style>

<div class="nav-container">

    <!-- BRAND -->
    <a href="{{ route('dashboard') }}" class="brand">

        <div class="brand-text">
            <span>Homero</span> Pet Shop
        </div>

    </a>

    <!-- LINKS -->
    <div class="links">

        @auth

            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('ventas.index') }}">
                Ventas
            </a>

            <a href="{{ route('compras.index') }}">
                Compras
            </a>

            <a href="{{ route('profile.edit') }}">
                Mi perfil
            </a>

            <a href="{{ route('productos.index') }}">
                Productos
            </a>

            @if(Auth::user()->role && Auth::user()->role->name === 'admin')

                <a href="{{ route('users.index') }}" class="admin-link">

                    Usuarios

                    <span class="admin-badge">
                        Admin
                    </span>

                </a>

            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn-logout" type="submit">
                    Cerrar sesión
                </button>
            </form>

        @else

            <a href="{{ route('login') }}">
                Ingresar
            </a>

            <a href="{{ route('register') }}">
                Crear cuenta
            </a>

        @endauth

    </div>

</div>

</nav>