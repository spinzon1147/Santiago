<x-guest-layout>
    <h2 style="font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;margin:0 0 4px 0">Verifica tu Correo</h2>
    <p style="font-size:14px;color:#94a3b8;margin:0 0 28px 0">Se ha enviado un enlace de verificación a tu correo electrónico</p>

    @if (session('status') === 'verification-link-sent')
        <div class="success-box">Un nuevo enlace de verificación ha sido enviado.</div>
    @endif

    <div style="display:flex;flex-direction:column;gap:12px">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary" style="width:100%">Reenviar Correo de Verificación</button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="display:block;width:100%;padding:14px 24px;border-radius:12px;border:none;font-size:14px;font-weight:500;color:#64748b;background:transparent;cursor:pointer;transition:all 0.2s" class="btn-ghost">Cerrar Sesión</button>
        </form>
    </div>
</x-guest-layout>

<style>
    .btn-ghost:hover{color:#0f172a !important;background:#f1f5f9 !important}
</style>
