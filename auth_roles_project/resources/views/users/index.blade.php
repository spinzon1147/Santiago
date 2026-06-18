@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="page-header">
    <div>
        <h1>Usuarios</h1>
        <p>Administración de usuarios del sistema</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn-primary">+ Nuevo Usuario</a>
</div>

@php
    $totalUsers = $users->count();
    $admins = $users->filter(fn($u) => $u->role?->name === 'admin')->count();
    $regUsers = $totalUsers - $admins;
@endphp
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Total usuarios</div>
        <div style="font-size:24px;font-weight:700;color:#202124">{{ $totalUsers }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Administradores</div>
        <div style="font-size:24px;font-weight:700;color:#ea8600">{{ $admins }}</div>
    </div>
    <div style="flex:1;min-width:120px;background:#fff;border-radius:16px;padding:16px 20px;box-shadow:0 1px 3px rgba(0,0,0,0.04);border:1px solid #e0e0e0">
        <div style="font-size:12px;color:#80868b;font-weight:500;margin-bottom:4px">Usuarios</div>
        <div style="font-size:24px;font-weight:700;color:#1a73e8">{{ $regUsers }}</div>
    </div>
</div>

<div class="card" style="padding:16px 20px;margin-bottom:20px">
    <form method="GET" action="{{ route('users.index') }}" style="display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap">
        <div style="flex:1;min-width:200px">
            <label class="input-label" style="font-size:11px">Buscar usuario</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre o email..." class="input" style="padding:10px 14px;font-size:13px">
        </div>
        <button type="submit" class="btn-secondary" style="padding:10px 20px;font-size:13px">Buscar</button>
        @if (request('search'))
            <a href="{{ route('users.index') }}" class="btn-secondary" style="padding:10px 20px;font-size:13px">Limpiar</a>
        @endif
    </form>
</div>

@if ($users->isEmpty())
    <div class="card empty-state">
        <svg width="64" height="64" fill="none" stroke="#cbd5e1" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <h3 style="font-size:16px;font-weight:600;color:#64748b;margin:0">No hay usuarios registrados</h3>
        <p style="font-size:14px;color:#94a3b8;margin:8px 0 20px">Crea el primer usuario del sistema</p>
        <a href="{{ route('users.create') }}" class="btn-primary">Nuevo Usuario</a>
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
                    <th>Rol</th>
                    <th>Registro</th>
                    <th style="text-align:right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td style="font-weight:600;color:#0f172a">{{ $user->id }}</td>
                    <td style="font-weight:500">{{ $user->name }}</td>
                    <td style="color:#64748b">{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role?->name === 'admin' ? 'badge-warning' : 'badge-info' }}">
                            {{ ucfirst($user->role?->name ?? 'usuario') }}
                        </span>
                    </td>
                    <td style="color:#64748b;font-size:13px">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td style="text-align:right">
                        @if (Auth::user()->isAdmin())
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                            <a href="{{ route('users.edit', $user->id) }}" class="action-link action-link-edit">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin:0" onsubmit="return confirm('¿Eliminar este usuario?')">
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
    {{ $users->appends(request()->query())->links() }}
@endif
@endsection
