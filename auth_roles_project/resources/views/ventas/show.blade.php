@extends('layouts.app')

@section('title', 'Detalle de Venta')

@section('content')
<div class="page-header">
    <div>
        <h1>Detalle de Venta #{{ $venta->Id_Ven }}</h1>
        <p>Información completa de la venta</p>
    </div>
    <div style="display:flex;gap:8px">
        <a href="{{ route('ventas.index') }}" class="btn-secondary">Volver</a>
        <a href="{{ route('ventas.factura', $venta->Id_Ven) }}" class="btn-pdf" style="--pdf-color:#059669" target="_blank">Factura</a>
        @if (Auth::user()->isAdmin())
        <a href="{{ route('ventas.edit', $venta->Id_Ven) }}" class="btn-primary">Editar</a>
        @endif
    </div>
</div>

<div class="card" style="max-width:600px">
    <table style="width:100%;border-collapse:collapse">
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;width:140px;border-bottom:1px solid #e2e8f0">ID Venta</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $venta->Id_Ven }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Producto</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $venta->producto->Nom_pro ?? '—' }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Cantidad</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $venta->Cant_Ven }} uds</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Total</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;font-weight:700">${{ number_format($venta->Total_Ven, 2) }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Fecha</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $venta->Fecha_Ven ? \Carbon\Carbon::parse($venta->Fecha_Ven)->format('d/m/Y h:i A') : '—' }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b">Registrado</td>
            <td style="padding:12px 16px">{{ $venta->created_at ? \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y h:i A') : '—' }}</td>
        </tr>
    </table>
</div>
@endsection
