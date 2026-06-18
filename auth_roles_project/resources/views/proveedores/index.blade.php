@extends('layouts.app')

@section('title', 'Proveedores')

@section('content')
<div class="page-header">
    <div>
        <h1>Proveedores</h1>
        <p>Gestión de proveedores y abastecimiento</p>
    </div>
    <a href="{{ route('proveedores.create') }}" class="btn-primary">+ Nuevo Proveedor</a>
</div>

@php
    $totalProv = $proveedores->count();
    $actProv = $proveedores->where('Estado_Prov', 'Activo')->count();
    $inactProv = $proveedores->where('Estado_Prov', 'Inactivo')->count();
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total proveedores</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalProv }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Activos</div>
        <div style="font-size:24px;font-weight:700;color:#188038">{{ $actProv }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Inactivos</div>
        <div style="font-size:24px;font-weight:700;color:#d93025">{{ $inactProv }}</div>
    </div>
</div>

<div class="card" style="padding:16px 20px;margin-bottom:20px">
    <form method="GET" action="{{ route('proveedores.index') }}" style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap">
        <div style="flex:1;min-width:200px">
            <label class="input-label" style="font-size:11px">Buscar proveedor</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre o tel&eacute;fono..." class="input" style="padding:10px 14px;font-size:13px">
        </div>
        <button type="submit" class="btn-secondary" style="padding:10px 20px;font-size:13px">Buscar</button>
        @if (request('search'))
            <a href="{{ route('proveedores.index') }}" class="btn-secondary" style="padding:10px 20px;font-size:13px">Limpiar</a>
        @endif
    </form>
</div>

@if ($proveedores->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay proveedores registrados</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Registra el primer proveedor para comenzar</p>
        <a href="{{ route('proveedores.create') }}" class="btn-primary">Nuevo Proveedor</a>
    </div>
@else
    <div class="table-wrap">
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $proveedor->Id_Prov }}</td>
                    <td style="font-weight:500">{{ $proveedor->Nom_Prov }}</td>
                    <td style="color:#64748b">{{ $proveedor->Tel_Prov }}</td>
                    <td style="color:#64748b;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $proveedor->Direc_Prov }}</td>
                    <td>
                        <span class="badge {{ $proveedor->Estado_Prov === 'Activo' ? 'badge-success' : 'badge-danger' }}">
                            {{ $proveedor->Estado_Prov }}
                        </span>
                    </td>
                    <td style="text-align:right">
                        @if (Auth::user()->isAdmin())
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            <a href="{{ route('proveedores.edit', $proveedor->Id_Prov) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('proveedores.destroy', $proveedor->Id_Prov) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar este proveedor?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-link action-link-delete">Eliminar</button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    {{ $proveedores->appends(request()->query())->links() }}
@endif
@endsection
