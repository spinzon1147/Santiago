<x-guest-layout>
    <h2 style="font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;margin:0 0 4px 0">Recuperar Contraseña</h2>
    <p style="font-size:14px;color:#94a3b8;margin:0 0 28px 0">Ingresa tu correo para recibir el enlace de restablecimiento</p>

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" style="display:flex;flex-direction:column;gap:20px">
        @csrf
        <div>
            <label class="input-label">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="correo@empresa.com" class="input">
        </div>
        <button type="submit" class="btn-primary" style="width:100%">Enviar Enlace</button>
    </form>
</x-guest-layout>
