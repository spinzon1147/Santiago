<x-guest-layout>
    <h2 style="font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;margin:0 0 4px 0">Iniciar Sesión</h2>
    <p style="font-size:14px;color:#94a3b8;margin:0 0 28px 0">Acceso al sistema administrativo</p>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" style="display:flex;flex-direction:column;gap:20px">
        @csrf
        <div>
            <label for="email" class="input-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="correo@empresa.com" class="input">
        </div>
        <div>
            <label for="password" class="input-label">Contraseña</label>
            <input type="password" name="password" id="password" required placeholder="Ingrese su contraseña" class="input">
        </div>
        <div style="display:flex;align-items:center;gap:10px">
            <input type="checkbox" name="remember" id="remember" style="width:16px;height:16px;border-radius:4px;border:1px solid #cbd5e1;accent-color:#ea580c">
            <label for="remember" style="font-size:14px;font-weight:500;color:#64748b;cursor:pointer">Recordarme</label>
        </div>
        <button type="submit" class="btn-primary" style="width:100%">Ingresar al Sistema</button>
    </form>
    <p style="margin-top:28px;text-align:center;font-size:12px;color:#94a3b8">Acceso restringido para personal autorizado</p>
    <p style="text-align:center;font-size:14px;color:#64748b;margin:12px 0 0">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" style="color:#ea580c;font-weight:600;text-decoration:none">Regístrate</a>
    </p>
</x-guest-layout>
