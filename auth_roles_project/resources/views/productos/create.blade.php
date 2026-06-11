@extends('layouts.app')

@section('title', 'Nuevo Producto')

@section('content')
<div style="max-width:640px;margin:0 auto">
    <a href="{{ route('productos.index') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Volver a Productos
    </a>
    <h1 style="font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin:0 0 24px 0">Nuevo Producto</h1>

    <div class="card">
        <form action="{{ route('productos.store') }}" method="POST" style="display:flex;flex-direction:column;gap:20px">
            @csrf
            @if ($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:16px 20px">
                <p style="font-size:14px;font-weight:600;color:#b91c1c;margin:0 0 8px">Corrige los siguientes errores:</p>
                <ul style="margin:0;padding-left:16px">
                    @foreach ($errors->all() as $error)
                    <li style="font-size:13px;color:#ef4444;margin-bottom:4px">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                <label class="input-label">Nombre del Producto</label>
                <input type="text" name="Nom_pro" value="{{ old('Nom_pro') }}" required placeholder="Nombre del producto" class="input @error('Nom_pro') is-invalid @enderror">
                @error('Nom_pro')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="input-label">Descripción <span style="color:#94a3b8;font-weight:400">(opcional)</span></label>
                <textarea name="Descrip_pro" rows="3" placeholder="Descripción del producto" class="input">{{ old('Descrip_pro') }}</textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Cantidad</label>
                    <input type="number" name="Cant_pro" value="{{ old('Cant_pro') }}" required min="0" placeholder="0" class="input @error('Cant_pro') is-invalid @enderror">
                    @error('Cant_pro')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Precio</label>
                    <div class="input-group">
                        <span style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;font-weight:500;pointer-events:none;z-index:1">$</span>
                        <input type="number" step="0.01" name="Precio_pro" value="{{ old('Precio_pro') }}" required min="0" placeholder="0.00" class="input @error('Precio_pro') is-invalid @enderror" style="padding-left:32px">
                    </div>
                    @error('Precio_pro')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="input-label">Estado</label>
                <select name="Estado_pro" required class="input @error('Estado_pro') is-invalid @enderror">
                    <option value="" disabled {{ !old('Estado_pro') ? 'selected' : '' }}>Seleccionar...</option>
                    <option value="Disponible" {{ old('Estado_pro') === 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="Agotado" {{ old('Estado_pro') === 'Agotado' ? 'selected' : '' }}>Agotado</option>
                    <option value="Descontinuado" {{ old('Estado_pro') === 'Descontinuado' ? 'selected' : '' }}>Descontinuado</option>
                </select>
                @error('Estado_pro')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Guardar Producto</button>
                <a href="{{ route('productos.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
