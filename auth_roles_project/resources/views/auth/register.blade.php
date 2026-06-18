<x-guest-layout>
    <h2 style="font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;margin:0 0 4px 0">Crear Cuenta</h2>
    <p style="font-size:14px;color:#94a3b8;margin:0 0 28px 0">Regístrate en el sistema administrativo</p>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" style="display:flex;flex-direction:column;gap:20px">
        @csrf
        <div>
            <label class="input-label">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre completo" class="input">
        </div>
        <div>
            <label class="input-label">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="correo@ejemplo.com" class="input">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div>
                <label class="input-label">Contraseña</label>
                <input type="password" name="password" required placeholder="Contraseña" class="input">
            </div>
            <div>
                <label class="input-label">Confirmar</label>
                <input type="password" name="password_confirmation" required placeholder="Repite la contraseña" class="input">
            </div>
        </div>
        <button type="submit" class="btn-primary" style="width:100%">Crear Cuenta</button>
        <p style="text-align:center;font-size:14px;color:#64748b;margin:0">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" style="color:#ea580c;font-weight:600;text-decoration:none">Inicia sesión</a>
        </p>
    </form>
</x-guest-layout>
