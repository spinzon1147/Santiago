@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<div class="page-header">
    <div>
        <h1>Inventario</h1>
        <p>Control de existencias y stock disponible</p>
    </div>
    <a href="{{ route('inventarios.create') }}" class="btn-primary">+ Nuevo Registro</a>
</div>

@php
    $totalInv = $inventarios->count();
    $totalStock = $inventarios->sum('Stock');
    $cats = $inventarios->pluck('Categoria')->filter()->unique()->count();
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Registros</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalInv }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Unidades totales</div>
        <div style="font-size:24px;font-weight:700;color:#188038">{{ $totalStock }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Categorías</div>
        <div style="font-size:24px;font-weight:700;color:#1a73e8">{{ $cats }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Inversión total</div>
        <div style="font-size:24px;font-weight:700;color:#d93025">${{ number_format($inventarios->sum(fn($i) => $i->Precio_Com * $i->Stock)) }}</div>
    </div>
</div>

<div class="card" style="padding:16px 20px;margin-bottom:20px">
    <form method="GET" action="{{ route('inventarios.index') }}" style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap">
        <div style="flex:1;min-width:200px">
            <label class="input-label" style="font-size:11px">Buscar por producto</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar producto en inventario..." class="input" style="padding:10px 14px;font-size:13px">
        </div>
        <button type="submit" class="btn-secondary" style="padding:10px 20px;font-size:13px">Buscar</button>
        @if (request('search'))
            <a href="{{ route('inventarios.index') }}" class="btn-secondary" style="padding:10px 20px;font-size:13px">Limpiar</a>
        @endif
    </form>
</div>

@if ($inventarios->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay registros de inventario</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Crea el primer registro de inventario</p>
        <a href="{{ route('inventarios.create') }}" class="btn-primary">Nuevo Registro</a>
    </div>
@else
    <div class="table-wrap">
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Stock</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Categoría</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventarios as $inventario)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $inventario->Id_Inven }}</td>
                    <td style="font-weight:500">{{ $inventario->producto->Nom_pro ?? '—' }}</td>
                    <td>{{ $inventario->proveedor->Nom_Prov ?? '—' }}</td>
                    <td>
                        <span style="font-weight:600;color:#0f172a">{{ $inventario->Stock }}</span>
                        <span style="font-size:12px;color:#94a3b8;margin-left:2px">uds</span>
                    </td>
                    <td style="font-weight:500">${{ number_format($inventario->Precio_Com, 2) }}</td>
                    <td style="font-weight:600">${{ number_format($inventario->Precio_Ven, 2) }}</td>
                    <td><span class="badge badge-info">{{ $inventario->Categoria }}</span></td>
                    <td style="text-align:right">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('inventarios.edit', $inventario->Id_Inven) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('inventarios.destroy', $inventario->Id_Inven) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar este registro?')">
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
    {{ $inventarios->appends(request()->query())->links() }}
@endif
@endsection
