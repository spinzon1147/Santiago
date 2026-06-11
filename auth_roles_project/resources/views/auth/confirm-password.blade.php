<x-guest-layout>
    <h2 style="font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;margin:0 0 4px 0">Confirmar Contraseña</h2>
    <p style="font-size:14px;color:#94a3b8;margin:0 0 28px 0">Por seguridad, confirma tu contraseña para continuar</p>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" style="display:flex;flex-direction:column;gap:20px">
        @csrf
        <div>
            <label class="input-label">Contraseña</label>
            <input type="password" name="password" required autofocus placeholder="Ingresa tu contraseña" class="input">
        </div>
        <button type="submit" class="btn-primary" style="width:100%">Confirmar</button>
    </form>
</x-guest-layout>
