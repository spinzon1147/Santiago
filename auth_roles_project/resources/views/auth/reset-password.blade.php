<x-guest-layout>
    <h2 style="font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;margin:0 0 4px 0">Restablecer Contraseña</h2>
    <p style="font-size:14px;color:#94a3b8;margin:0 0 28px 0">Ingresa tu nueva contraseña</p>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" style="display:flex;flex-direction:column;gap:20px">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label class="input-label">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="correo@empresa.com" class="input">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div>
                <label class="input-label">Nueva Contraseña</label>
                <input type="password" name="password" required placeholder="Mínimo 6 caracteres" class="input">
            </div>
            <div>
                <label class="input-label">Confirmar</label>
                <input type="password" name="password_confirmation" required placeholder="Repite la contraseña" class="input">
            </div>
        </div>
        <button type="submit" class="btn-primary" style="width:100%">Restablecer Contraseña</button>
    </form>
</x-guest-layout>
