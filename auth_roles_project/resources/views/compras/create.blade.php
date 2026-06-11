@extends('layouts.app')

@section('title', 'Nueva Compra')

@section('content')
<div style="max-width:640px;margin:0 auto">
    <a href="{{ route('compras.index') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Volver a Compras
    </a>
    <h1 style="font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin:0 0 24px 0">Nueva Compra</h1>

    <div class="card">
        <form action="{{ route('compras.store') }}" method="POST" style="display:flex;flex-direction:column;gap:20px">
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
                <label class="input-label">Producto</label>
                <select name="Id_Prod_FK" required class="input @error('Id_Prod_FK') is-invalid @enderror" id="producto-select">
                    <option value="" disabled {{ !old('Id_Prod_FK') ? 'selected' : '' }}>Seleccionar...</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->Id_pro }}" data-precio="{{ $producto->Precio_pro }}" {{ old('Id_Prod_FK') == $producto->Id_pro ? 'selected' : '' }}>{{ $producto->Nom_pro }} — ${{ number_format($producto->Precio_pro, 2) }}</option>
                    @endforeach
                </select>
                @error('Id_Prod_FK')<p class="input-error">{{ $message }}</p>@enderror
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Cantidad</label>
                    <input type="number" name="Cant_Com" id="cantidad-input" value="{{ old('Cant_Com') }}" required min="1" placeholder="1" class="input @error('Cant_Com') is-invalid @enderror">
                    @error('Cant_Com')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Fecha de Compra</label>
                    <input type="datetime-local" name="Fecha_Com" value="{{ old('Fecha_Com', now()->format('Y-m-d\TH:i')) }}" required class="input @error('Fecha_Com') is-invalid @enderror">
                    @error('Fecha_Com')<p class="input-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                <div>
                    <label class="input-label">Precio de Compra (por unidad)</label>
                    <div class="input-group">
                        <span style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;font-weight:500;pointer-events:none;z-index:1">$</span>
                        <input type="number" step="0.01" name="Precio_Com" id="precio-compra" value="{{ old('Precio_Com') }}" required min="0" placeholder="0.00" class="input @error('Precio_Com') is-invalid @enderror" style="padding-left:32px">
                    </div>
                    @error('Precio_Com')<p class="input-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label">Total</label>
                    <div class="input-group">
                        <span style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;font-weight:500;pointer-events:none;z-index:1">$</span>
                        <input type="text" id="total-display" readonly placeholder="0.00" class="input" style="padding-left:32px;font-weight:700;color:#ea580c;background:#fff7ed;border-color:#fed7aa;cursor:default">
                    </div>
                </div>
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
            <hr class="section-divider">
            <div style="display:flex;align-items:center;gap:12px">
                <button type="submit" class="btn-primary">Guardar Compra</button>
                <a href="{{ route('compras.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cantInput = document.getElementById('cantidad-input');
        const precInput = document.getElementById('precio-compra');
        const totalDisplay = document.getElementById('total-display');

        function actualizar() {
            const cantidad = parseFloat(cantInput.value) || 0;
            const precio = parseFloat(precInput.value) || 0;
            totalDisplay.value = (cantidad * precio).toFixed(2);
        }

        cantInput.addEventListener('input', actualizar);
        precInput.addEventListener('input', actualizar);
    });
</script>
@endpush
@endsection