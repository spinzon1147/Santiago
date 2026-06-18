@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="page-header">
    <div>
        <h1>Productos</h1>
        <p>Gestión de productos del pet shop</p>
    </div>
    <div style="display:flex;align-items:center;gap:10px">
        <a href="{{ route('reportes.productos') }}" class="btn-pdf" target="_blank" style="--pdf-color:#059669">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v4a1 1 0 001 1h4"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a3 3 0 016 0v2"/></svg>
            PDF Inventario
        </a>
        <a href="{{ route('productos.create') }}" class="btn-primary">+ Nuevo Producto</a>
    </div>
</div>

@php
    $totalProd = $productos->count();
    $dispProd = $productos->where('Estado_pro', 'Disponible')->count();
    $agotProd = $productos->where('Estado_pro', 'Agotado')->count();
    $bajoProd = $productos->filter(fn($p) => $p->Cant_pro > 0 && $p->Cant_pro < 5)->count();
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalProd }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Disponibles</div>
        <div style="font-size:24px;font-weight:700;color:#188038">{{ $dispProd }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Agotados</div>
        <div style="font-size:24px;font-weight:700;color:#d93025">{{ $agotProd }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Stock bajo</div>
        <div style="font-size:24px;font-weight:700;color:#ea8600">{{ $bajoProd }}</div>
    </div>
</div>

<div class="card" style="padding:16px 20px;margin-bottom:20px">
    <form method="GET" action="{{ route('productos.index') }}" style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap">
        <div style="flex:1;min-width:200px">
            <label class="input-label" style="font-size:11px">Buscar por nombre</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar producto..." class="input" style="padding:10px 14px;font-size:13px">
        </div>
        <button type="submit" class="btn-secondary" style="padding:10px 20px;font-size:13px">Buscar</button>
        @if (request('search'))
            <a href="{{ route('productos.index') }}" class="btn-secondary" style="padding:10px 20px;font-size:13px">Limpiar</a>
        @endif
    </form>
</div>

@if ($productos->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay productos registrados</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Crea tu primer producto para comenzar</p>
        <a href="{{ route('productos.create') }}" class="btn-primary">Crear Producto</a>
    </div>
@else
    <div class="table-wrap">
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $producto->Id_pro }}</td>
                    <td style="font-weight:500">{{ $producto->Nom_pro }}</td>
                    <td style="color:#64748b;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $producto->Descrip_pro ?? '—' }}</td>
                    <td>
                        <span style="font-weight:600;color:#0f172a">{{ $producto->Cant_pro }}</span>
                        <span style="font-size:12px;color:#94a3b8;margin-left:2px">uds</span>
                    </td>
                    <td style="font-weight:600">${{ number_format($producto->Precio_pro, 2) }}</td>
                    <td>
                        <span class="badge {{ $producto->Estado_pro === 'Disponible' ? 'badge-success' : ($producto->Estado_pro === 'Agotado' ? 'badge-danger' : 'badge-warning') }}">
                            {{ $producto->Estado_pro }}
                        </span>
                    </td>
                    <td style="text-align:right">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('productos.edit', $producto->Id_pro) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->Id_pro) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar este producto?')">
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
    {{ $productos->appends(request()->query())->links() }}
@endif
@endsection
