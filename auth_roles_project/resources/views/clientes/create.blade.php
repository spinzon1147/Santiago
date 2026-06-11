@extends('layouts.app')

@section('title', 'Nuevo Cliente')

@section('content')
<div style="max-width:640px;margin:0 auto">
    <a href="{{ route('clientes.index') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Volver a Clientes
    </a>
    <h1 style="font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin:0 0 24px 0">Nuevo Cliente</h1>

    <div class="card">
        <form action="{{ route('clientes.store') }}" method="POST" style="display:flex;flex-direction:column;gap:20px">
            @csrf
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
                <label class="input-label">Nombre del Cliente</label>
                <input type="text" name="Nom_Cli" value="{{ old('Nom_Cli') }}" required placeholder="Nombre completo" class="input @error('Nom_Cli') is-invalid @enderror">
                @error('Nom_Cli')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="input-label">Correo Electrónico</label>
                <input type="email" name="Email_Cli" value="{{ old('Email_Cli') }}" required placeholder="correo@ejemplo.com" class="input @error('Email_Cli') is-invalid @enderror">
                @error('Email_Cli')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Teléfono</label>
                    <input type="text" name="Tel_Cli" value="{{ old('Tel_Cli') }}" required placeholder="+52 123 456 7890" class="input @error('Tel_Cli') is-invalid @enderror">
                    @error('Tel_Cli')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Estado</label>
                    <select name="Estado_Cli" required class="input @error('Estado_Cli') is-invalid @enderror">
                        <option value="" disabled {{ !old('Estado_Cli') ? 'selected' : '' }}>Seleccionar...</option>
                        <option value="Activo" {{ old('Estado_Cli') === 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('Estado_Cli') === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('Estado_Cli')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="input-label">Dirección</label>
                <input type="text" name="Direc_Cli" value="{{ old('Direc_Cli') }}" required placeholder="Calle, número, colonia, ciudad" class="input @error('Direc_Cli') is-invalid @enderror">
                @error('Direc_Cli')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Guardar Cliente</button>
                <a href="{{ route('clientes.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
