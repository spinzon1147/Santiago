@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="page-header">
    <div>
        <h1>Clientes</h1>
        <p>Administración de información de clientes</p>
    </div>
    <a href="{{ route('clientes.create') }}" class="btn-primary">+ Nuevo Cliente</a>
</div>

@php
    $totalCli = $clientes->count();
    $actCli = $clientes->where('Estado_Cli', 'Activo')->count();
    $inactCli = $clientes->where('Estado_Cli', 'Inactivo')->count();
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total clientes</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalCli }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Activos</div>
        <div style="font-size:24px;font-weight:700;color:#188038">{{ $actCli }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Inactivos</div>
        <div style="font-size:24px;font-weight:700;color:#d93025">{{ $inactCli }}</div>
    </div>
</div>

@if ($clientes->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay clientes registrados</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Registra el primer cliente para comenzar</p>
        <a href="{{ route('clientes.create') }}" class="btn-primary">Nuevo Cliente</a>
    </div>
@else
    <div class="table-wrap">
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $cliente->Id_Cli }}</td>
                    <td style="font-weight:500">{{ $cliente->Nom_Cli }}</td>
                    <td style="color:#64748b">{{ $cliente->Email_Cli }}</td>
                    <td style="color:#64748b">{{ $cliente->Tel_Cli }}</td>
                    <td style="color:#64748b;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $cliente->Direc_Cli }}</td>
                    <td>
                        <span class="badge {{ $cliente->Estado_Cli === 'Activo' ? 'badge-success' : 'badge-danger' }}">
                            {{ $cliente->Estado_Cli }}
                        </span>
                    </td>
                    <td style="text-align:right">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            <a href="{{ route('clientes.edit', $cliente->Id_Cli) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->Id_Cli) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar este cliente?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-link action-link-delete">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endif
@endsection
