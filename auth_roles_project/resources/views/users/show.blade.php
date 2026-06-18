@extends('layouts.app')

@section('title', 'Detalle del Usuario')

@section('content')
<div class="page-header">
    <div>
        <h1>Detalle del Usuario</h1>
        <p>Información completa del usuario</p>
    </div>
    <div style="display:flex;gap:8px">
        <a href="{{ route('users.index') }}" class="btn-secondary">Volver</a>
        @if (Auth::user()->isAdmin())
        <a href="{{ route('users.edit', $user->id) }}" class="btn-primary">Editar</a>
        @endif
    </div>
</div>

<div class="card" style="max-width:600px">
    <table style="width:100%;border-collapse:collapse">
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;width:140px;border-bottom:1px solid #e2e8f0">ID</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $user->id }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Nombre</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $user->name }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Email</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">{{ $user->email }}</td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0">Rol</td>
            <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0">
                <span class="badge {{ $user->role?->name === 'admin' ? 'badge-warning' : 'badge-info' }}">
                    {{ ucfirst($user->role?->name ?? 'usuario') }}
                </span>
            </td>
        </tr>
        <tr>
            <td style="padding:12px 16px;font-weight:600;color:#64748b">Registro</td>
            <td style="padding:12px 16px">{{ $user->created_at->format('d/m/Y h:i A') }}</td>
        </tr>
    </table>
</div>
@endsection
