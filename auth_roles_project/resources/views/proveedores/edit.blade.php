@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')
<div style="max-width:640px;margin:0 auto">
    <a href="{{ route('proveedores.index') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Volver a Proveedores
    </a>
    <h1 style="font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin:0 0 24px 0">Editar Proveedor</h1>

    <div class="card">
        <form action="{{ route('proveedores.update', $proveedor->Id_Prov) }}" method="POST" style="display:flex;flex-direction:column;gap:20px">
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
                <label class="input-label">Nombre del Proveedor</label>
                <input type="text" name="Nom_Prov" value="{{ old('Nom_Prov', $proveedor->Nom_Prov) }}" required placeholder="Nombre de la empresa" class="input @error('Nom_Prov') is-invalid @enderror">
                @error('Nom_Prov')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Teléfono</label>
                    <input type="text" name="Tel_Prov" value="{{ old('Tel_Prov', $proveedor->Tel_Prov) }}" required placeholder="+52 123 456 7890" class="input @error('Tel_Prov') is-invalid @enderror">
                    @error('Tel_Prov')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Estado</label>
                    <select name="Estado_Prov" required class="input @error('Estado_Prov') is-invalid @enderror">
                        <option value="Activo" {{ old('Estado_Prov', $proveedor->Estado_Prov) === 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('Estado_Prov', $proveedor->Estado_Prov) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('Estado_Prov')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="input-label">Dirección</label>
                <input type="text" name="Direc_Prov" value="{{ old('Direc_Prov', $proveedor->Direc_Prov) }}" required placeholder="Calle, número, colonia, ciudad" class="input @error('Direc_Prov') is-invalid @enderror">
                @error('Direc_Prov')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Actualizar Proveedor</button>
                <a href="{{ route('proveedores.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
