@extends('layouts.app')

@section('title', 'Nuevo Registro de Inventario')

@section('content')
<div style="max-width:640px;margin:0 auto">
    <a href="{{ route('inventarios.index') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Volver a Inventario
    </a>
    <h1 style="font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin:0 0 24px 0">Nuevo Registro de Inventario</h1>

    <div class="card">
        <form action="{{ route('inventarios.store') }}" method="POST" style="display:flex;flex-direction:column;gap:20px">
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
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Producto</label>
                    <select name="Id_Producto" required class="input @error('Id_Producto') is-invalid @enderror">
                        <option value="" disabled {{ !old('Id_Producto') ? 'selected' : '' }}>Seleccionar...</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->Id_pro }}" {{ old('Id_Producto') == $producto->Id_pro ? 'selected' : '' }}>{{ $producto->Nom_pro }}</option>
                        @endforeach
                    </select>
                    @error('Id_Producto')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Proveedor <span style="color:#94a3b8;font-weight:400">(opcional)</span></label>
                    <select name="Id_Proveedor" class="input @error('Id_Proveedor') is-invalid @enderror">
                        <option value="">Seleccionar...</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->Id_Prov }}" {{ old('Id_Proveedor') == $proveedor->Id_Prov ? 'selected' : '' }}>{{ $proveedor->Nom_Prov }}</option>
                        @endforeach
                    </select>
                    @error('Id_Proveedor')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Precio Compra</label>
                    <div class="input-group">
                        <span style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;font-weight:500;pointer-events:none;z-index:1">$</span>
                        <input type="number" step="0.01" name="Precio_Com" value="{{ old('Precio_Com') }}" required min="0" placeholder="0.00" class="input @error('Precio_Com') is-invalid @enderror" style="padding-left:32px">
                    </div>
                    @error('Precio_Com')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Precio Venta</label>
                    <div class="input-group">
                        <span style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;font-weight:500;pointer-events:none;z-index:1">$</span>
                        <input type="number" step="0.01" name="Precio_Ven" value="{{ old('Precio_Ven') }}" required min="0" placeholder="0.00" class="input @error('Precio_Ven') is-invalid @enderror" style="padding-left:32px">
                    </div>
                    @error('Precio_Ven')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Stock</label>
                    <input type="number" name="Stock" value="{{ old('Stock') }}" required min="0" placeholder="0" class="input @error('Stock') is-invalid @enderror">
                    @error('Stock')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Categoría <span style="color:#94a3b8;font-weight:400">(opcional)</span></label>
                    <input type="text" name="Categoria" value="{{ old('Categoria') }}" placeholder="Ej: Alimentos, Juguetes" class="input @error('Categoria') is-invalid @enderror">
                    @error('Categoria')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Descripción <span style="color:#94a3b8;font-weight:400">(opcional)</span></label>
                    <textarea name="Descripcion" rows="3" placeholder="Descripción del registro..." class="input @error('Descripcion') is-invalid @enderror">{{ old('Descripcion') }}</textarea>
                    @error('Descripcion')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Guardar Registro</button>
                <a href="{{ route('inventarios.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
