@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div style="max-width:640px;margin:0 auto">
    <a href="{{ route('users.index') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Volver a Usuarios
    </a>
    <h1 style="font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin:0 0 24px 0">Editar Usuario</h1>

    <div class="card">
        <form action="{{ route('users.update', $user->id) }}" method="POST" style="display:flex;flex-direction:column;gap:20px">
            @csrf @method('PATCH')
            @if ($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:16px 20px;margin-bottom:8px">
                <p style="font-size:14px;font-weight:600;color:#b91c1c;margin:0 0 8px">Corrige los siguientes errores:</p>
                <ul style="margin:0;padding-left:16px">
                    @foreach ($errors->all() as $error)
                    <li style="font-size:13px;color:#ef4444;margin-bottom:4px">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                <label class="input-label">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="Nombre completo" class="input @error('name') is-invalid @enderror">
                @error('name')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="input-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="correo@ejemplo.com" class="input @error('email') is-invalid @enderror">
                @error('email')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Nueva Contraseña <span style="color:#94a3b8;font-weight:400">(opcional)</span></label>
                    <input type="password" name="password" placeholder="Dejar vacío para mantener" class="input @error('password') is-invalid @enderror">
                    @error('password')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" placeholder="Repite la contraseña" class="input @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="input-label">Rol</label>
                <select name="role_id" required class="input @error('role_id') is-invalid @enderror">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                @error('role_id')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Actualizar Usuario</button>
                <a href="{{ route('users.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
