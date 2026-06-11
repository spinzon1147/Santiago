@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div style="max-width:560px;margin:0 auto">
    <div style="margin-bottom:28px">
        <h1 style="font-size:28px;font-weight:700;color:#1e293b;letter-spacing:-0.6px;margin:0">Mi Perfil</h1>
        <p style="font-size:14px;color:#94a3b8;margin:4px 0 0 0">Actualiza tu información personal</p>
    </div>

    @if(session('status') === 'profile-updated')
        <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:16px;padding:16px 24px;margin-bottom:24px;color:#047857;font-size:14px;font-weight:500;display:flex;align-items:center;gap:12px;box-shadow:0 1px 3px rgba(0,0,0,0.04)">
            <div style="width:32px;height:32px;border-radius:12px;background:#d1fae5;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg width="16" height="16" fill="none" stroke="#047857" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            Perfil actualizado correctamente
        </div>
    @endif

    <div class="card">
        <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid #f1ece8">
            <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:20px;box-shadow:0 4px 16px rgba(249,115,22,0.25);flex-shrink:0">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <p style="font-size:16px;font-weight:600;color:#1e293b;margin:0">{{ $user->name }}</p>
                <p style="font-size:13px;color:#94a3b8;margin:2px 0 0 0">{{ $user->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" style="display:flex;flex-direction:column;gap:24px">
            @csrf @method('PATCH')
            <div>
                <label class="input-label">Nombre completo</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input">
                @error('name') <p class="input-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="input-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="input">
                @error('email') <p class="input-error">{{ $message }}</p> @enderror
            </div>
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Guardar Cambios</button>
                <a href="{{ route('dashboard') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
