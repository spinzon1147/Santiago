@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="page-header">
    <div>
        <h1>Ventas</h1>
        <p>Administración y seguimiento de ventas</p>
    </div>
    <div style="display:flex;align-items:center;gap:10px">
        <a href="{{ route('reportes.ventas') }}" class="btn-pdf" target="_blank" style="--pdf-color:#dc2626">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v4a1 1 0 001 1h4"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a3 3 0 016 0v2"/></svg>
            PDF Ventas
        </a>
        <a href="{{ route('ventas.create') }}" class="btn-primary">+ Nueva Venta</a>
    </div>
</div>

@php
    $totalVen = $ventas->count();
    $totalIngresos = $ventas->sum('Total_Ven');
    $promVen = $totalVen > 0 ? $totalIngresos / $totalVen : 0;
    $hoyVen = $ventas->filter(fn($v) => \Carbon\Carbon::parse($v->Fecha_Ven)->isToday())->count();
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total ventas</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalVen }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Ventas hoy</div>
        <div style="font-size:24px;font-weight:700;color:#188038">{{ $hoyVen }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total ingresos</div>
        <div style="font-size:24px;font-weight:700;color:#202124">${{ number_format($totalIngresos) }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Promedio x venta</div>
        <div style="font-size:24px;font-weight:700;color:#1a73e8">${{ number_format($promVen) }}</div>
    </div>
</div>

<div class="card" style="padding:16px 20px;margin-bottom:20px">
    <form method="GET" action="{{ route('ventas.index') }}" style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap">
        <div style="flex:1;min-width:180px">
            <label class="input-label" style="font-size:11px">Buscar producto</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre del producto..." class="input" style="padding:10px 14px;font-size:13px">
        </div>
        <div>
            <label class="input-label" style="font-size:11px">Desde</label>
            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="input" style="padding:10px 14px;font-size:13px;width:170px">
        </div>
        <div>
            <label class="input-label" style="font-size:11px">Hasta</label>
            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="input" style="padding:10px 14px;font-size:13px;width:170px">
        </div>
        <button type="submit" class="btn-secondary" style="padding:10px 20px;font-size:13px">Buscar</button>
        @if (request('search') || request()->has('fecha_desde') || request()->has('fecha_hasta'))
            <a href="{{ route('ventas.index') }}" class="btn-secondary" style="padding:10px 20px;font-size:13px">Limpiar</a>
        @endif
    </form>
</div>

@if ($ventas->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay ventas registradas</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Registra la primera venta para comenzar</p>
        <a href="{{ route('ventas.create') }}" class="btn-primary">Nueva Venta</a>
    </div>
@else
    <div class="table-wrap">
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $venta->Id_Ven }}</td>
                    <td style="font-weight:500">{{ $venta->producto->Nom_pro ?? '—' }}</td>
                    <td>
                        <span style="font-weight:600;color:#0f172a">{{ $venta->Cant_Ven }}</span>
                        <span style="font-size:12px;color:#94a3b8;margin-left:2px">uds</span>
                    </td>
                    <td style="font-weight:600">${{ number_format($venta->Total_Ven, 2) }}</td>
                    <td style="color:#64748b;font-size:13px">{{ $venta->Fecha_Ven ? \Carbon\Carbon::parse($venta->Fecha_Ven)->format('d/m/Y h:i A') : '—' }}</td>
                    <td style="text-align:right">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            <a href="{{ route('ventas.factura', $venta->Id_Ven) }}" class="action-link" style="color:#059669" target="_blank">Factura</a>
                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('ventas.edit', $venta->Id_Ven) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('ventas.destroy', $venta->Id_Ven) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar esta venta?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-link action-link-delete">Eliminar</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    {{ $ventas->appends(request()->query())->links() }}
@endif
@endsection
