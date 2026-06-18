@extends('layouts.app')

@section('title', 'Compras')

@section('content')
<div class="page-header">
    <div>
        <h1>Compras</h1>
        <p>Control y registro de compras de productos</p>
    </div>
    <div style="display:flex;align-items:center;gap:10px">
        <a href="{{ route('reportes.compras') }}" class="btn-pdf" target="_blank" style="--pdf-color:#2563eb">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v4a1 1 0 001 1h4"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a3 3 0 016 0v2"/></svg>
            PDF Compras
        </a>
        <a href="{{ route('compras.create') }}" class="btn-primary">+ Nueva Compra</a>
    </div>
</div>

@php
    $totalCom = $compras->count();
    $totalInvertido = $compras->sum('Valor_Com');
    $promCom = $totalCom > 0 ? $totalInvertido / $totalCom : 0;
    $mesCom = $compras->filter(fn($c) => \Carbon\Carbon::parse($c->Fecha_Com)->isCurrentMonth())->count();
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total compras</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalCom }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Este mes</div>
        <div style="font-size:24px;font-weight:700;color:#188038">{{ $mesCom }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total invertido</div>
        <div style="font-size:24px;font-weight:700;color:#202124">${{ number_format($totalInvertido) }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Promedio x compra</div>
        <div style="font-size:24px;font-weight:700;color:#1a73e8">${{ number_format($promCom) }}</div>
    </div>
</div>

<div class="card" style="padding:16px 20px;margin-bottom:20px">
    <form method="GET" action="{{ route('compras.index') }}" style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap">
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
            <a href="{{ route('compras.index') }}" class="btn-secondary" style="padding:10px 20px;font-size:13px">Limpiar</a>
        @endif
    </form>
</div>

@if ($compras->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay compras registradas</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Registra la primera compra para comenzar</p>
        <a href="{{ route('compras.create') }}" class="btn-primary">Nueva Compra</a>
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
                    <th>Precio Und.</th>
                    <th>Total</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $compra->Id_Com }}</td>
                    <td style="font-weight:500">{{ $compra->producto->Nom_pro ?? '—' }}</td>
                    <td>
                        <span style="font-weight:600;color:#0f172a">{{ $compra->Cant_Com }}</span>
                        <span style="font-size:12px;color:#94a3b8;margin-left:2px">uds</span>
                    </td>
                    <td style="font-weight:600">${{ number_format($compra->Precio_Com ?? 0) }}</td>
                    <td style="font-weight:600">${{ number_format($compra->Valor_Com) }}</td>
                    <td style="color:#64748b;font-size:13px">{{ $compra->proveedor->Nom_Prov ?? '—' }}</td>
                    <td style="color:#64748b;font-size:13px">{{ $compra->Fecha_Com ? \Carbon\Carbon::parse($compra->Fecha_Com)->format('d/m/Y') : '—' }}</td>
                    <td style="text-align:right">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('compras.edit', $compra->Id_Com) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('compras.destroy', $compra->Id_Com) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar esta compra?')">
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
    {{ $compras->appends(request()->query())->links() }}
@endif
@endsection
